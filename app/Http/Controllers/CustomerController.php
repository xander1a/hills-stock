<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();
        
        // Search functionality
        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('category', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }
        
        // Category filter
        if ($request->has('category') && $request->category) {
            $query->where('category', $request->category);
        }
        
        // Price range filter
        if ($request->has('min_price') && $request->min_price) {
            $query->where('price', '>=', $request->min_price);
        }
        
        if ($request->has('max_price') && $request->max_price) {
            $query->where('price', '<=', $request->max_price);
        }
        
        // Only show products with stock
        $query->where('total_quantity', '>', 0);
        
        $products = $query->orderBy('name')->paginate(12);
        $categories = Product::distinct()->pluck('category');
        
        // Get cart items count
        $cartCount = collect(Session::get('cart', []))->sum('quantity');
        
        return view('customer.index', compact('products', 'categories', 'cartCount'));
    }
    
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);
        
        $product = Product::findOrFail($request->product_id);
        
        // Check stock availability
        if (!$product->isInStock($request->quantity)) {
            return back()->with('error', 'Not enough stock available. Only ' . $product->total_quantity . ' items left.');
        }
        
        $cart = Session::get('cart', []);
        $productId = $request->product_id;
        
        if (isset($cart[$productId])) {
            $newQuantity = $cart[$productId]['quantity'] + $request->quantity;
            if (!$product->isInStock($newQuantity)) {
                return back()->with('error', 'Cannot add more items. Only ' . $product->total_quantity . ' items available.');
            }
            $cart[$productId]['quantity'] = $newQuantity;
        } else {
            $cart[$productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $request->quantity,
                'image_path' => $product->image_path,
                'sku' => $product->sku,
            ];
        }
        
        Session::put('cart', $cart);
        
        return back()->with('success', 'Product added to cart successfully!');
    }
    
    public function cart()
    {
        $cart = Session::get('cart', []);
        $total = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });
        
        return view('customer.cart-index', compact('cart', 'total'));
    }
    
    public function updateCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'quantity' => 'required|integer|min:1'
        ]);
        
        $cart = Session::get('cart', []);
        $productId = $request->product_id;
        
        if (isset($cart[$productId])) {
            $product = Product::find($productId);
            if ($product && $product->isInStock($request->quantity)) {
                $cart[$productId]['quantity'] = $request->quantity;
                Session::put('cart', $cart);
                return back()->with('success', 'Cart updated successfully!');
            } else {
                return back()->with('error', 'Not enough stock available.');
            }
        }
        
        return back()->with('error', 'Product not found in cart.');
    }
    
    public function removeFromCart(Request $request)
    {
        $cart = Session::get('cart', []);
        $productId = $request->product_id;
        
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            Session::put('cart', $cart);
            return back()->with('success', 'Product removed from cart!');
        }
        
        return back()->with('error', 'Product not found in cart.');
    }
    
    public function checkout()
    {
        $cart = Session::get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('customer.products')->with('error', 'Your cart is empty.');
        }
        
        $total = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });
        
        return view('customer.checkout', compact('cart', 'total'));
    }
    
    public function placeOrder(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'nullable|string|max:20',
            'customer_address' => 'required|string',
            'notes' => 'nullable|string'
        ]);
        
        $cart = Session::get('cart', []);
        
        if (empty($cart)) {
            return back()->with('error', 'Your cart is empty.');
        }
        
        try {
            DB::beginTransaction();
            
            // Calculate total
            $totalAmount = collect($cart)->sum(function ($item) {
                return $item['price'] * $item['quantity'];
            });
            
            // Create order
            $order = Order::create([
                'customer_id' => 0, // Guest customer
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_phone' => $request->customer_phone,
                'customer_address' => $request->customer_address,
                'total_amount' => $totalAmount,
                'status' => 'pending',
                'notes' => $request->notes,
            ]);
            
            // Create order items and update product quantities
            foreach ($cart as $item) {
                $product = Product::find($item['id']);
                
                if (!$product || !$product->isInStock($item['quantity'])) {
                    throw new \Exception('Product ' . $item['name'] . ' is out of stock.');
                }
                
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'product_sku' => $product->sku,
                    'unit_price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'total_price' => $item['price'] * $item['quantity'],
                ]);
                
                // Update product quantity
                $product->decrement('total_quantity', $item['quantity']);
            }
            
            DB::commit();
            
            // Clear cart
            Session::forget('cart');
            
            return redirect()->route('customer.order.success', $order->id)
                           ->with('success', 'Order placed successfully!');
                           
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to place order: ' . $e->getMessage());
        }
    }
    
    public function orderSuccess($orderId)
    {
        $order = Order::with('orderItems')->findOrFail($orderId);
        return view('customer.order-success', compact('order'));
    }
}