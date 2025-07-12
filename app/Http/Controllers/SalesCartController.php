<?php

namespace App\Http\Controllers;

use App\Models\SalesCart;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;

class SalesCartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

   public function addToCart(Request $request, $productId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($productId);
        
        // Check if requested quantity is available
        if ($request->quantity > $product->total_quantity) {
            return back()->with('error', 'Insufficient stock. Available: ' . $product->total_quantity);
        }

        // Get or create cart session
        $cartSessionId = Session::get('cart_session_id');
        if (!$cartSessionId) {
            $cartSessionId = SalesCart::generateSessionId();
            Session::put('cart_session_id', $cartSessionId);
        }

        // Check if product already exists in cart
        $existingCartItem = SalesCart::bySession($cartSessionId)
            ->where('product_id', $productId)
            ->where('status', 'pending')
            ->first();

        if ($existingCartItem) {
            // Update existing cart item
            $newQuantity = $existingCartItem->quantity + $request->quantity;
            
            if ($newQuantity > $product->total_quantity) {
                return back()->with('error', 'Total quantity exceeds available stock. Available: ' . $product->total_quantity);
            }

            $existingCartItem->update([
                'quantity' => $newQuantity,
                'total_price' => $newQuantity * $product->price
            ]);
        } else {
            // Create new cart item
            SalesCart::create([
                'session_id' => $cartSessionId,
                'product_id' => $productId,
                'quantity' => $request->quantity,
                'unit_price' => $product->price,
                'total_price' => $request->quantity * $product->price,
                'status' => 'pending',
                'export_type' => 'payed', 
            ]);
        }

        return back()->with('success', 'Product added to cart successfully!');
    }

    /**
     * Remove product from cart
     */
    public function removeFromCart($cartItemId)
    {
        $cartItem = SalesCart::findOrFail($cartItemId);
        $cartItem->delete();

        return back()->with('success', 'Product removed from cart!');
    }

    /**
     * Update cart item quantity
     */
    public function updateCartItem(Request $request, $cartItemId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem = SalesCart::with('product')->findOrFail($cartItemId);
        
        if ($request->quantity > $cartItem->product->total_quantity) {
            return back()->with('error', 'Insufficient stock. Available: ' . $cartItem->product->total_quantity);
        }

        $cartItem->update([
            'quantity' => $request->quantity,
            'total_price' => $request->quantity * $cartItem->unit_price
        ]);

        return back()->with('success', 'Cart updated successfully!');
    }

    /**
     * Clear entire cart
     */
    public function clearCart()
    {
        $cartSessionId = Session::get('cart_session_id');
        if ($cartSessionId) {
            SalesCart::bySession($cartSessionId)->pending()->delete();
            Session::forget('cart_session_id');
        }

        return back()->with('success', 'Cart cleared successfully!');
    }

    /**
     * Process sale (complete the cart)
     */
    public function processSale(Request $request)
    {
        $request->validate([
            'customer_name' => 'nullable|string|max:255',
            'customer_phone' => 'nullable|string|max:20',
            'notes' => 'nullable|string',
            'export_type' => 'required|in:payed,debt,free'
        ]);

        $cartSessionId = Session::get('cart_session_id');
        if (!$cartSessionId) {
            return back()->with('error', 'No items in cart!');
        }

        $cartItems = SalesCart::bySession($cartSessionId)->pending()->with('product')->get();
        
        if ($cartItems->isEmpty()) {
            return back()->with('error', 'No items in cart!');
        }

        // Check stock availability for all items
        foreach ($cartItems as $item) {
            if ($item->quantity > $item->product->total_quantity) {
                return back()->with('error', "Product '{$item->product->name}' has insufficient stock!");
            }
        }

        // Process the sale
        foreach ($cartItems as $item) {
            // Update product quantity
            $item->product->decrement('total_quantity', $item->quantity);
            
            // Update cart item status
            $item->update([
                'status' => 'pending', 
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'notes' => $request->notes,
                'export_type' => $request->export_type,
                'sale_date' => now()
            ]);
        }

        // Clear session
        Session::forget('cart_session_id');

        return redirect()->route('products.index')->with('success', 'Sale completed successfully!');
    }

    public function salesHistory()
    {
        $sales = SalesCart::with('product')
            ->whereIn('status', ['completed', 'failed', 'pending'])
            ->orderBy('sale_date', 'desc')
            ->paginate(20);

        // Group sales by session_id for better display
        $groupedSales = $sales->groupBy('session_id');

        return view('sales.grouped', compact('sales', 'groupedSales'));
    }

    /**
     * Update sale status
     */
    public function updateSaleStatus(Request $request, $sessionId)
    {
        $request->validate([
            'status' => 'required|in:pending,completed,failed'
        ]);

        $salesItems = SalesCart::where('session_id', $sessionId)->get();
        
        if ($salesItems->isEmpty()) {
            return back()->with('error', 'Sale not found!');
        }

        foreach ($salesItems as $item) {
            $item->update([
                'status' => $request->status,
                'sale_date' => $request->status === 'completed' ? now() : $item->sale_date
            ]);
        }

        return back()->with('success', 'Sale status updated successfully!');
    }

    /**
     * Download PDF for completed sale
     */
    public function downloadSalePDF($sessionId)
    {
        $salesItems = SalesCart::with('product')
            ->where('session_id', $sessionId)
            ->where('status', 'completed')
            ->get();

        if ($salesItems->isEmpty()) {
            return back()->with('error', 'No completed sale found for this session!');
        }

        $saleData = [
            'session_id' => $sessionId,
            'sale_date' => $salesItems->first()->sale_date,
            'customer_name' => $salesItems->first()->customer_name,
            'customer_phone' => $salesItems->first()->customer_phone,
            'notes' => $salesItems->first()->notes,
            'items' => $salesItems,
            'total' => $salesItems->sum('total_price')
        ];

        $pdf = Pdf::loadView('sales.groupedPDF', $saleData);
        
        return $pdf->download('groupedPDF-' . substr($sessionId, -8) . '.pdf');
    }
}