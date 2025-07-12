<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - Product Details</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Navigation Bar -->
    @include('dashboard.navbar')

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto p-6">
        <!-- Breadcrumb -->
        <nav class="flex mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('products.index') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-red-500">
                        Products
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-red-500 md:ml-2">{{ $product->name }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Product Header -->
        <div class="bg-white shadow-lg border-2 border-red-500 p-6 mb-6">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                <div class="flex items-center mb-4 lg:mb-0">
                    <div class="w-16 h-16 bg-gray-200 border-2 border-red-300 flex items-center justify-center mr-6">
                        @if($product->image_path)
                            <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                        @else
                            <span class="text-gray-500 text-sm">IMG</span>
                        @endif
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">{{ $product->name }}</h1>
                        <p class="text-gray-600">
                            {{ $product->mainCategory->name ?? $product->category }} • 
                            SKU: {{ $product->sku ?? 'N/A' }}
                        </p>
                    </div>
                </div>
                
                <div class="flex flex-col sm:flex-row gap-4">

                        <a href="{{ route('products.sell', $product) }}" class="bg-green-500 text-white px-6 py-2 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors font-medium flex items-center justify-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m-3-9h6M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
</svg>
                        <span>Sell Product</span>
                    </a>

                    <a href="{{ route('products.edit', $product) }}" class="bg-blue-500 text-white px-6 py-2 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors font-medium flex items-center justify-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        <span>Edit Product</span>
                    </a>
                    <form method="POST" action="{{ route('products.destroy', $product) }}" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this product?')" class="bg-red-500 text-white px-6 py-2 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors font-medium flex items-center justify-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            <span>Delete</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Product Details Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            <!-- Basic Information -->
            <div class="bg-white shadow-lg border-2 border-red-500 p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4H9m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Basic Information
                </h2>
                <div class="space-y-4">
                    <div>
                        <span class="text-sm font-medium text-gray-500">Product Name</span>
                        <p class="text-gray-800 font-semibold">{{ $product->name }}</p>
                    </div>
                    <div>
                        <span class="text-sm font-medium text-gray-500">Main Category</span>
                        <p class="text-gray-800">{{ $product->mainCategory->name ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <span class="text-sm font-medium text-gray-500">Brand</span>
                        <p class="text-gray-800">{{ $product->brand->name ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <span class="text-sm font-medium text-gray-500">Type</span>
                        <p class="text-gray-800">{{ $product->type->name ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <span class="text-sm font-medium text-gray-500">Size/Code</span>
                        <p class="text-gray-800">{{ $product->size_or_code ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <span class="text-sm font-medium text-gray-500">SKU</span>
                        <p class="text-gray-800">{{ $product->sku ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <span class="text-sm font-medium text-gray-500">Supplier</span>
                        <p class="text-gray-800">{{ $product->supplier ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

            <!-- Pricing & Stock -->
            <div class="bg-white shadow-lg border-2 border-red-500 p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                    Pricing & Stock
                </h2>
                <div class="space-y-4">
                    <div>
                        <span class="text-sm font-medium text-gray-500">Price</span>
                        <p class="text-2xl font-bold text-red-500">${{ number_format($product->price, 2) }}</p>
                    </div>
                    <div>
                        <span class="text-sm font-medium text-gray-500">Total Quantity</span>
                        <p class="text-gray-800 font-semibold">{{ number_format($product->total_quantity) }}</p>
                    </div>
                    <div>
                        <span class="text-sm font-medium text-gray-500">Sold</span>
                        <p class="text-green-600 font-semibold">{{ number_format($product->total_sold) }}</p>
                    </div>
                    <div>
                        <span class="text-sm font-medium text-gray-500">Remaining</span>
                        <p class="text-blue-600 font-semibold">{{ number_format($product->remaining_stock) }}</p>
                    </div>
                    <div>
                        <span class="text-sm font-medium text-gray-500">Min Stock Level</span>
                        <p class="text-gray-800">{{ $product->min_stock ?? 'Not set' }}</p>
                    </div>
                </div>
            </div>

            <!-- Performance -->
            <div class="bg-white shadow-lg border-2 border-red-500 p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    Performance
                </h2>
                <div class="space-y-4">
                    <div>
                        <span class="text-sm font-medium text-gray-500">Sales Performance</span>
                        @php
                            $salePercentage = $product->total_quantity > 0 ? ($product->total_sold / $product->total_quantity) * 100 : 0;
                        @endphp
                        <div class="flex items-center mt-1">
                            <div class="w-full bg-gray-200 h-2 border border-red-500 mr-2">
                                <div class="bg-red-500 h-full" style="width: {{ $salePercentage }}%"></div>
                            </div>
                            <span class="text-red-500 font-bold text-sm">{{ number_format($salePercentage, 1) }}%</span>
                        </div>
                    </div>
                    <div>
                        <span class="text-sm font-medium text-gray-500">Total Revenue</span>
                        <p class="text-xl font-bold text-green-600">${{ number_format($product->total_revenue, 2) }}</p>
                    </div>
                    <div>
                        <span class="text-sm font-medium text-gray-500">Total Sales</span>
                        <p class="text-gray-800 font-semibold">{{ $product->sales_count }} transactions</p>
                    </div>
                    <div>
                        <span class="text-sm font-medium text-gray-500">Stock Status</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 text-xs font-medium {{ $product->stock_status_color }}">
                            {{ $product->stock_status }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Description -->
        <div class="bg-white shadow-lg border-2 border-red-500 p-6 mb-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Product Description
            </h2>
            <p class="text-gray-700 leading-relaxed">
                {{ $product->description ?? 'No description available for this product.' }}
            </p>
        </div>

        <!-- Recent Sales Activity -->
        
        
    </div>
</body>
</html>