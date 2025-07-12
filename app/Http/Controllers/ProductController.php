<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\MainCategory;
use App\Models\Brand;
use App\Models\Type;
use App\Models\Size;
use App\Models\SalesCart;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        
        // Get current cart session
        $cartSessionId = Session::get('cart_session_id');
        $cartItems = [];
        $cartTotal = 0;
        
        if ($cartSessionId) {
            $cartItems = SalesCart::bySession($cartSessionId)->pending()->with('product')->get();
            $cartTotal = $cartItems->sum('total_price');
        }
        
        return view('products.index', compact('products', 'cartItems', 'cartTotal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mainCategories = MainCategory::all();
        $brands = Brand::all();
        $types = Type::all();
        $sizes = Size::all();
        return view('products.create', compact('mainCategories', 'brands', 'types', 'sizes'));
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $validated = $request->validate([
        // New category fields
        'main_category_id' => 'required|integer|exists:main_categories,id',
        'brand_id' => 'required|integer|exists:brands,id',
        'type_id' => 'required|integer|exists:types,id',
        'size_or_code' => 'required|string|max:255',
        
        // Existing fields
        'name' => 'required|string|max:255',
        'category' => 'required|string',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'total_quantity' => 'required|integer|min:0',
        'min_stock' => 'nullable|integer|min:0',
        'image' => 'nullable|image|max:5120', // 5MB max
        'sku' => 'nullable|string|max:255',
        'supplier' => 'nullable|string|max:255',
    ]);

    $user_id = "1";

    if ($request->hasFile('image')) {
        $validated['image_path'] = $request->file('image')->store('products', 'public');
    }
    
    $validated['user_id'] = $user_id; // Assuming user_id is set to 1 for now

    Product::create($validated);

    return redirect()->back()->with('success', 'Product added successfully!');
}

    /**
     * Display the specified resource.
     */
public function show(Product $product)
    {
        // Load the product with all its relationships and calculated fields
        $product = Product::with(['mainCategory', 'brand', 'type', 'sales'])
            ->withCount('sales')
            ->findOrFail($product->id);
        
        // Get recent sales activity for this product
        $recentActivity = $product->sales()
            ->latest()
            ->take(5)
            ->get();
        
        return view('products.show', compact('product', 'recentActivity'));
    }

    public function sell(Product $product)
    {

       
        return view('products.sell', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        // Load the product with relationships
        $product = Product::with(['mainCategory', 'brand', 'type'])->findOrFail($product->id);
        
        // Get all categories, brands, and types for the dropdown options
        $mainCategories = MainCategory::orderBy('name')->get();
        $brands = Brand::orderBy('name')->get();
        $types = Type::orderBy('name')->get();
        
        return view('products.edit', compact('product', 'mainCategories', 'brands', 'types'));
    }

    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'main_category_id' => 'required|exists:main_categories,id',
            'brand_id' => 'required|exists:brands,id',
            'type_id' => 'required|exists:types,id',
            'size_or_code' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'total_quantity' => 'required|integer|min:0',
            'min_stock' => 'nullable|integer|min:0',
            'sku' => 'nullable|string|max:255|unique:products,sku,' . $product->id,
            'supplier' => 'nullable|string|max:255',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle image upload
        if ($request->hasFile('product_image')) {
            // Delete old image if exists
            if ($product->image_path && Storage::exists('public/' . $product->image_path)) {
                Storage::delete('public/' . $product->image_path);
            }
            
            // Store new image
            $imagePath = $request->file('product_image')->store('products', 'public');
            $validatedData['image_path'] = $imagePath;
        }

        // Update the product
        $product->update($validatedData);

        return redirect()->route('products.show', $product)
            ->with('success', 'Product updated successfully!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }

}
