@extends('customer.navbar')

@section('title', 'Products')

@section('content')
<div class="min-h-screen bg-gray-50">
    {{-- <!-- Header -->
    <div class="bg-white shadow-sm border-b-2 border-red-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <h1 class="text-3xl font-bold text-red-600">Our Products</h1>
                <a href="{{ route('customer.cart') }}" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg flex items-center space-x-2 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5-6m9.5 6v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"></path>
                    </svg>
                    <span>Cart ({{ $cartCount }})</span>
                </a>
            </div>
        </div>
    </div> --}}

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Filters -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <form method="GET" action="{{ route('customer.products') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Search products..." 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                    <select name="category" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                                {{ $category }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Min Price</label>
                    <input type="number" name="min_price" value="{{ request('min_price') }}" 
                           placeholder="0" step="0.01"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Max Price</label>
                    <input type="number" name="max_price" value="{{ request('max_price') }}" 
                           placeholder="1000" step="0.01"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
                </div>
                
                <div class="md:col-span-4 flex space-x-4">
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-md transition-colors">
                        Filter Products
                    </button>
                    <a href="{{ route('customer.products') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-md transition-colors">
                        Clear Filters
                    </a>
                </div>
            </form>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                {{ session('error') }}
            </div>
        @endif

        <!-- Products Grid -->
        @if($products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($products as $product)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                        <!-- Product Image -->
                        <div class="h-48 bg-gray-200 flex items-center justify-center">
                            @if($product->image_path)
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" 
                                     class="w-full h-full object-cover">
                            @else
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            @endif
                        </div>
                        
                        <!-- Product Info -->
                        <div class="p-4">
                            <h3 class="font-semibold text-lg text-gray-800 mb-2">{{ $product->name }}</h3>
                            <p class="text-sm text-gray-600 mb-2">{{ $product->category }}</p>
                            @if($product->description)
                                <p class="text-sm text-gray-500 mb-3 line-clamp-2">{{ Str::limit($product->description, 80) }}</p>
                            @endif
                            
                            <div class="flex justify-between items-center mb-3">
                                <span class="text-2xl font-bold text-red-600">${{ number_format($product->price, 2) }}</span>
                                <span class="text-sm text-gray-500">Stock: {{ $product->total_quantity }}</span>
                            </div>
                            
                            @if($product->sku)
                                <p class="text-xs text-gray-400 mb-3">SKU: {{ $product->sku }}</p>
                            @endif
                            
                            <!-- Add to Cart Form -->
                            <form action="{{ route('customer.cart.add') }}" method="POST" class="space-y-3">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                
                                <div class="flex items-center space-x-2">
                                    <label class="text-sm font-medium text-gray-700">Qty:</label>
                                    <input type="number" name="quantity" value="1" min="1" max="{{ $product->total_quantity }}"
                                           class="w-16 px-2 py-1 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
                                </div>
                                
                                <button type="submit" 
                                        class="w-full bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-md transition-colors font-medium {{ $product->total_quantity == 0 ? 'opacity-50 cursor-not-allowed' : '' }}"
                                        {{ $product->total_quantity == 0 ? 'disabled' : '' }}>
                                    @if($product->total_quantity == 0)
                                        Out of Stock
                                    @else
                                        Add to Cart
                                    @endif
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="mt-8">
                {{ $products->appends(request()->query())->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                    </path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No products found</h3>
                <p class="mt-1 text-sm text-gray-500">Try adjusting your search or filter criteria.</p>
            </div>
        @endif
    </div>
</div>
@endsection