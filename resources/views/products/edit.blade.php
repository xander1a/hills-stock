<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit {{ $product->name }} - Inventory Dashboard</title>
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
                        <a href="{{ route('products.show', $product) }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-red-500 md:ml-2">{{ $product->name }}</a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-red-500 md:ml-2">Edit</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Page Header -->
        <div class="bg-white shadow-lg border-2 border-red-500 p-6 mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Edit Product</h1>
                    <p class="text-gray-600 mt-2">Update product information and inventory details</p>
                </div>
                <a href="{{ route('products.show', $product) }}" class="bg-gray-500 text-white px-6 py-2 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors font-medium flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span>Back to Product</span>
                </a>
            </div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Error Messages -->
        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6" role="alert">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Edit Form -->
        <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Basic Information Section -->
            <div class="bg-white shadow-lg border-2 border-red-500 p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                    <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4H9m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Basic Information
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Product Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Product Name *</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500" 
                               required>
                    </div>

                    <!-- SKU -->
                    <div>
                        <label for="sku" class="block text-sm font-medium text-gray-700 mb-2">SKU</label>
                        <input type="text" id="sku" name="sku" value="{{ old('sku', $product->sku) }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                    </div>

                    <!-- Main Category -->
                    <div>
                        <label for="main_category_id" class="block text-sm font-medium text-gray-700 mb-2">Main Category *</label>
                        <select id="main_category_id" name="main_category_id" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500" 
                                required>
                            <option value="">Select Main Category</option>
                            @foreach($mainCategories as $category)
                                <option value="{{ $category->id }}" {{ old('main_category_id', $product->main_category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Brand -->
                    <div>
                        <label for="brand_id" class="block text-sm font-medium text-gray-700 mb-2">Brand *</label>
                        <select id="brand_id" name="brand_id" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500" 
                                required>
                            <option value="">Select Brand</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Type -->
                    <div>
                        <label for="type_id" class="block text-sm font-medium text-gray-700 mb-2">Type *</label>
                        <select id="type_id" name="type_id" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500" 
                                required>
                            <option value="">Select Type</option>
                            @foreach($types as $type)
                                <option value="{{ $type->id }}" {{ old('type_id', $product->type_id) == $type->id ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Size or Code -->
                    <div>
                        <label for="size_or_code" class="block text-sm font-medium text-gray-700 mb-2">Size/Code *</label>
                        <input type="text" id="size_or_code" name="size_or_code" value="{{ old('size_or_code', $product->size_or_code) }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500" 
                               required>
                    </div>

                    <!-- Legacy Category -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Legacy Category *</label>
                        <input type="text" id="category" name="category" value="{{ old('category', $product->category) }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500" 
                               required>
                    </div>

                    <!-- Supplier -->
                    <div>
                        <label for="supplier" class="block text-sm font-medium text-gray-700 mb-2">Supplier</label>
                        <input type="text" id="supplier" name="supplier" value="{{ old('supplier', $product->supplier) }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                    </div>
                </div>

                <!-- Description -->
                <div class="mt-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea id="description" name="description" rows="4" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
                              placeholder="Enter product description...">{{ old('description', $product->description) }}</textarea>
                </div>
            </div>

            <!-- Pricing & Inventory Section -->
            <div class="bg-white shadow-lg border-2 border-red-500 p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                    <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                    Pricing & Inventory
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Price -->
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Price ($) *</label>
                        <input type="number" id="price" name="price" step="0.01" min="0" value="{{ old('price', $product->price) }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500" 
                               required>
                    </div>

                    <!-- Total Quantity -->
                    <div>
                        <label for="total_quantity" class="block text-sm font-medium text-gray-700 mb-2">Total Quantity *</label>
                        <input type="number" id="total_quantity" name="total_quantity" min="0" value="{{ old('total_quantity', $product->total_quantity) }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500" 
                               required>
                    </div>

                    <!-- Minimum Stock -->
                    <div>
                        <label for="min_stock" class="block text-sm font-medium text-gray-700 mb-2">Minimum Stock Level</label>
                        <input type="number" id="min_stock" name="min_stock" min="0" value="{{ old('min_stock', $product->min_stock) }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                    </div>
                </div>

                <!-- Current Stock Info -->
                <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                    <h3 class="text-sm font-medium text-gray-700 mb-2">Current Stock Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                        <div>
                            <span class="text-gray-500">Total Sold:</span>
                            <span class="font-semibold text-green-600">{{ $product->total_sold }} units</span>
                        </div>
                        <div>
                            <span class="text-gray-500">Remaining Stock:</span>
                            <span class="font-semibold text-blue-600">{{ $product->remaining_stock }} units</span>
                        </div>
                        <div>
                            <span class="text-gray-500">Stock Status:</span>
                            <span class="inline-flex items-center px-2.5 py-0.5 text-xs font-medium {{ $product->stock_status_color }}">
                                {{ $product->stock_status }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Image Section -->
            <div class="bg-white shadow-lg border-2 border-red-500 p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                    <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Product Image
                </h2>

                <div class="flex items-start space-x-6">
                    <!-- Current Image -->
                    <div class="flex-shrink-0">
                        <div class="w-32 h-32 bg-gray-200 border-2 border-gray-300 rounded-lg flex items-center justify-center overflow-hidden">
                            @if($product->image_path)
                                <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-gray-400 text-sm">No Image</span>
                            @endif
                        </div>
                    </div>

                    <!-- Upload New Image -->
                    <div class="flex-grow">
                        <label for="product_image" class="block text-sm font-medium text-gray-700 mb-2">Upload New Image</label>
                        <input type="file" id="product_image" name="product_image" accept="image/*" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                        <p class="mt-2 text-sm text-gray-500">Supported formats: JPEG, PNG, JPG, GIF. Max size: 2MB</p>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="bg-white shadow-lg border-2 border-red-500 p-6">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-500">
                        <span class="text-red-500">*</span> Required fields
                    </div>
                    <div class="flex space-x-4">
                        <a href="{{ route('products.show', $product) }}" 
                           class="bg-gray-500 text-white px-6 py-2 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors font-medium">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="bg-red-500 text-white px-6 py-2 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors font-medium flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Update Product</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        // Preview image before upload
        document.getElementById('product_image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const currentImageContainer = document.querySelector('.w-32.h-32');
                    currentImageContainer.innerHTML = `<img src="${e.target.result}" alt="Preview" class="w-full h-full object-cover">`;
                };
                reader.readAsDataURL(file);
            }
        });

        // Form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const requiredFields = this.querySelectorAll('[required]');
            let hasErrors = false;

            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.classList.add('border-red-500');
                    hasErrors = true;
                } else {
                    field.classList.remove('border-red-500');
                }
            });

            if (hasErrors) {
                e.preventDefault();
                alert('Please fill in all required fields.');
            }
        });
    </script>
</body>
</html>