<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product - Inventory Dashboard</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Navigation Bar -->
     @include('dashboard.navbar')

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto p-6">
        <div class="flex items-center mb-8">
            <svg class="w-8 h-8 text-red-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            <h2 class="text-3xl font-bold text-gray-800">Add New Product</h2>
        </div>
        
        <!-- Form Container -->
        <div class="bg-white shadow-lg border-2 border-red-500 p-8">
          <form id="addProductForm" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <!-- Product Categories Section -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                        Product Categories
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="mainCategory" class="block text-sm font-medium text-gray-700 mb-2">Main Category </label>
                            <select id="mainCategory" required name="main_category_id"
                                    class="w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors">
                                <option value="">Select Main Category</option>
                                @foreach($mainCategories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div>
                            <label for="brand" class="block text-sm font-medium text-gray-700 mb-2">Brand </label>
                            <select id="brand" required name="brand_id"
                                    class="w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors">
                                <option value="">Select Brand</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Type </label>
                            <select id="type" required name="type_id"
                                    class="w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors">
                                <option value="">Select Type</option>
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div>
                            <label for="sizeOrCode" class="block text-sm font-medium text-gray-700 mb-2">Size or Product Code </label>
                            <input type="text" id="sizeOrCode" required name="size_or_code"
                                   class="w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors"
                                   placeholder="Enter size or product code">
                        </div>
                    </div>
                </div>

                <!-- Product Basic Information -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4H9m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Basic Information
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="productName" class="block text-sm font-medium text-gray-700 mb-2">Product Name </label>
                            <input type="text" id="productName" required name="name"
                                   class="w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors"
                                   placeholder="Enter product name">
                        </div>
                        
                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Category </label>
                            <select id="category" required name="category"
                                    class="w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors">
                                <option value="">Select Category</option>
                                <option value="electronics">Electronics</option>
                                <option value="clothing">Clothing</option>
                                <option value="books">Books</option>
                                <option value="home">Home & Garden</option>
                                <option value="sports">Sports & Outdoors</option>
                                <option value="toys">Toys & Games</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea id="description" rows="3" name="description"
                                  class="w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors"
                                  placeholder="Enter product description"></textarea>
                    </div>
                </div>

                <!-- Pricing and Inventory -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                        Pricing & Inventory
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Price (Frw) </label>
                            <input type="number" id="price" name="price" step="0.01" min="0" required
                                   class="w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors"
                                   placeholder="0.00">
                        </div>
                        
                        <div>
                            <label for="totalQuantity" class="block text-sm font-medium text-gray-700 mb-2">Total Quantity </label>
                            <input type="number" id="totalQuantity" name="total_quantity" min="0" required
                                   class="w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors"
                                   placeholder="0">
                        </div>
                        
                        <div>
                            <label for="minStock" class="block text-sm font-medium text-gray-700 mb-2">Minimum Stock Level</label>
                            <input type="number" id="minStock" name="min_stock" min="0" 
                                   class="w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors"
                                   placeholder="0">
                        </div>
                    </div>
                </div>

               <!-- Product Image -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        Product Image
                    </h3>

                    <div class="flex flex-col items-center space-y-4">
                        <input type="file" id="productImage" name="image" accept="image/*"
                               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                                      file:rounded-md file:border-0
                                      file:text-sm file:font-semibold
                                      file:bg-red-50 file:text-red-700
                                      hover:file:bg-red-100"/>

                        <div id="imagePreview" class="w-32 h-32 border rounded-lg bg-gray-100 flex items-center justify-center text-gray-400">
                            <span class="text-sm">Preview</span>
                        </div>
                    </div>
                </div>

                <!-- Additional Details -->
                <div class="pb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Additional Details
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="sku" class="block text-sm font-medium text-gray-700 mb-2">SKU</label>
                            <input type="text" id="sku" name="sku"
                                   class="w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors"
                                   placeholder="Enter SKU">
                        </div>
                        
                        <div>
                            <label for="supplier" class="block text-sm font-medium text-gray-700 mb-2">Supplier</label>
                            <input type="text" id="supplier" name="supplier"
                                   class="w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors"
                                   placeholder="Enter supplier name">
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                    <button type="submit" 
                            class="flex-1 bg-red-500 text-white py-3 px-6 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors font-medium flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>Add Product</span>
                    </button>
                    
                    <button type="button" 
                            class="flex-1 bg-gray-500 text-white py-3 px-6 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors font-medium flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        <span>Cancel</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
    document.getElementById('productImage').addEventListener('change', function (event) {
        const preview = document.getElementById('imagePreview');
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover rounded-lg" />`;
            };
            reader.readAsDataURL(file);
        } else {
            preview.innerHTML = `<span class="text-sm text-gray-400">Preview</span>`;
        }
    });
</script>
    
</body>
</html>