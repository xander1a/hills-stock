<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class SalesController extends Controller
{
    // Show sales page
    public function index()
    {
        $sales = Sale::with('product')->latest()->get();

      
        return view('sales.index', compact('sales'));
    }

    // Show form to add a sale
    public function create()
    {
        $products = Product::all();
        return view('sales.create', compact('products'));
    }

    // Store new sale record
    public function store(Request $request)
{
    // Validate input
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1',
        'sale_date' => 'required|date',
        'payment_method' => 'required|string',
        'discount' => 'nullable|numeric|min:0|max:100',
        'customer_name' => 'nullable|string|max:255',
        'customer_email' => 'nullable|email|max:255',
        'total_amount' => 'required|numeric|min:0',
    ]);

    // Fetch product
    $product = Product::findOrFail($request->product_id);

    // Check stock availability
    if ($request->quantity > $product->total_quantity) {
        return back()->with('error', 'Insufficient stock available for this product.');
    }

    // Apply discount
    $discount = $request->discount ?? 0;
    $subtotal = $product->price * $request->quantity;
    $discountAmount = ($subtotal * $discount) / 100;
    $finalAmount = $subtotal - $discountAmount;

    // Create sale record
    $sale = new Sale();
    $sale->product_id = $product->id;
    $sale->quantity = $request->quantity;
    $sale->customer_name = $request->customer_name;
    $sale->payment_method = $request->payment_method;
    $sale->status = 'completed';
    $sale->invoice_number = 'INV-' . strtoupper(Str::random(6));
    $sale->transaction_id = strtoupper(Str::uuid());
    $sale->seller_id = Auth::id(); // optional
    $sale->total_price = $finalAmount;
    $sale->created_at = $request->sale_date;

    $sale->save();

    // Reduce stock
    $product->total_quantity -= $request->quantity;
    $product->save();

    return redirect()->route('products.index')->with('success', 'Sale recorded successfully.');
}
}
