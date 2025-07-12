<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Inventory Dashboard</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Navigation Bar -->
    @include('dashboard.navbar')
    
    <!-- Alert Messages -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto mt-4 px-6">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto mt-4 px-6">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto p-6">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800">Product Inventory</h2>
            <div class="flex space-x-4">
                <!-- Cart Button -->
                <button id="cartToggle" class="bg-blue-500 text-white px-6 py-3 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors font-medium flex items-center space-x-2 relative">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l1.5-6M17 21a2 2 0 100-4 2 2 0 000 4zM9 21a2 2 0 100-4 2 2 0 000 4z"></path>
                    </svg>
                    <span>Order</span>
                    @if(count($cartItems) > 0)
                        <span class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs">{{ count($cartItems) }}</span>
                    @endif
                </button>


                    <a href="{{ route('salesCart.index') }}" class="bg-green-500 text-white px-6 py-3 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors font-medium flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <span>View Order</span>
                </a>
                
                <a href="{{ route('products.create') }}" class="bg-red-500 text-white px-6 py-3 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors font-medium flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <span>Add Product</span>
                </a>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="mb-6">
            <div class="relative max-w-lg">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input 
                    type="text" 
                    id="searchInput" 
                    placeholder="Search products by name..." 
                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-red-500 focus:border-red-500 text-sm font-medium"
                >
            </div>
        </div>

        <!-- Cart Sidebar -->
        <div id="cartSidebar" class="fixed inset-y-0 right-0 w-96 bg-white shadow-xl transform translate-x-full transition-transform duration-300 ease-in-out z-50">
            <div class="flex flex-col h-full">
                <div class="flex items-center justify-between p-4 border-b">
                    <h3 class="text-lg font-semibold">Order Product</h3>
                    <button id="closeSidebar" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <div class="flex-1 overflow-y-auto p-4">
                    @if(count($cartItems) > 0)
                        @foreach($cartItems as $item)
                            <div class="flex items-center space-x-3 p-3 border-b">
                                <div class="w-12 h-12 bg-gray-200 border border-red-300 flex items-center justify-center">
                                    @if($item->product->image_path)
                                        <img src="{{ asset('storage/' . $item->product->image_path) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                    @else
                                        <span class="text-xs text-gray-500">IMG</span>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-sm font-medium">{{ $item->product->name }}</h4>
                                    <p class="text-xs text-gray-500">${{ number_format($item->unit_price, 2) }} each</p>
                                    <div class="flex items-center space-x-2 mt-1">
                                        <form action="{{ route('products.updateCartItem', $item->id) }}" method="POST" class="flex items-center space-x-1">
                                            @csrf
                                            @method('PUT')
                                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->total_quantity }}" class="w-16 px-2 py-1 text-xs border rounded">
                                            <button type="submit" class="text-xs bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600">Update</button>
                                        </form>
                                        <form action="{{ route('products.removeFromCart', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-xs bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">Remove</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-bold">${{ number_format($item->total_price, 2) }}</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-gray-500 text-center mt-8">Your Order is empty</p>
                    @endif
                </div>

                @if(count($cartItems) > 0)
                    <div class="border-t p-4">
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-lg font-bold">Total: ${{ number_format($cartTotal, 2) }}</span>
                        </div>
                        
                        <form action="{{ route('products.processSale') }}" method="POST" class="space-y-3">
                            @csrf
                            <input type="text" name="customer_name" placeholder="Customer Name (Optional)" class="w-full px-3 py-2 border rounded">
                            <input type="text" name="customer_phone" placeholder="Customer Phone (Optional)" class="w-full px-3 py-2 border rounded">
                            <textarea name="notes" placeholder="Notes (Optional)" rows="2" class="w-full px-3 py-2 border rounded"></textarea>


                            <div>
                                <label for ="export_type" class="block text-sm font-medium text-gray-700">Export type</label>
                                <select id="export_type" name="export_type" class="mt-1 block w-full px-3 py-2 border rounded">
                                    <option value="payed">Payed</option>
                                    <option value="debt">Debt</option>
                                    <option value="free">Free</option>
                                </select>
                            </div>
                            
                            <div class="flex space-x-2">
                                <button type="submit" class="flex-1 bg-green-500 text-white py-2 rounded hover:bg-green-600 font-medium">Complete Sale</button>
                                <a href="{{ route('products.clearCart') }}" class="flex-1 bg-gray-500 text-white py-2 rounded hover:bg-gray-600 font-medium text-center">Clear items</a>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>

        <!-- Overlay -->
        <div id="cartOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden"></div>
        
        <!-- Table Container -->
        <div class="bg-white shadow-lg border-2 border-red-500 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-red-500">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Product</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Price</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Total Qty</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Ranking</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Progress</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="productTableBody">
                        @foreach ($products as $item)
                            <tr class="hover:bg-gray-50 transition-colors product-row">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 bg-gray-200 border border-red-300 flex items-center justify-center mr-4">
                                            @if($item->image_path)
                                                <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->name }}" class="w-full h-full object-cover">
                                            @else
                                                <span class="text-xs text-gray-500">IMG</span>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900 product-name">{{ $item->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $item->category }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-lg font-bold text-red-500">Frw {{ number_format($item->price, 2) }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-gray-800 font-semibold">{{ $item->total_quantity }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-red-500 font-bold">{{ $item->total_quantity > 0 ? number_format(($item->sold_quantity / $item->total_quantity) * 100, 2) : 0 }}%</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="w-24 bg-gray-200 h-2 border border-red-500">
                                        <div class="bg-red-500 h-full" style="width: {{ $item->total_quantity > 0 ? ($item->sold_quantity / $item->total_quantity) * 100 : 0 }}%"></div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex space-x-2 flex-wrap">
                                        {{-- View Details Button --}}
                                        <a href="{{ route('products.show', $item->id) }}"
                                           class="bg-red-500 text-white px-3 py-1 text-xs hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors font-medium flex items-center space-x-1 mb-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.065 7-9.542 7s-8.268-2.943-9.542-7z" />
                                            </svg>
                                            <span>View</span>
                                        </a>

                                        {{-- Sell Button --}}
                                        <a href="{{ route('products.sell', $item->id) }}"
                                           class="bg-green-500 text-white px-3 py-1 text-xs hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors font-medium flex items-center space-x-1 mb-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.104 0-2 .672-2 1.5S10.896 11 12 11s2 .672 2 1.5S13.104 14 12 14m0-6v12m0-12C9.243 8 7 9.79 7 12s2.243 4 5 4 5-1.79 5-4-2.243-4-5-4z" />
                                            </svg>
                                            <span>Sell</span>
                                        </a>

                                        {{-- Add to Cart Button --}}
                                        @if($item->total_quantity > 0)
                                            <button onclick="openAddToCartModal({{ $item->id }}, '{{ $item->name }}', {{ $item->price }}, {{ $item->total_quantity }})"
                                                    class="bg-blue-500 text-white px-3 py-1 text-xs hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors font-medium flex items-center space-x-1 mb-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l1.5-6M17 21a2 2 0 100-4 2 2 0 000 4zM9 21a2 2 0 100-4 2 2 0 000 4z" />
                                                </svg>
                                                <span>Add to Order</span>
                                            </button>
                                        @else
                                            <span class="bg-gray-400 text-white px-3 py-1 text-xs font-medium rounded">Out of Stock</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

  <!-- Add to Cart Modal -->
<div id="addToCartModal" class="fixed inset-0 bg-black bg-opacity-60 backdrop-blur-sm overflow-y-auto h-full w-full z-50 hidden flex items-center justify-center p-4">
    <div class="relative mx-auto p-8 border-0 w-full max-w-md shadow-2xl  bg-white transform transition-all duration-300 ease-out">
        <div class="relative">
            <!-- Header with gradient background -->
            <div class="text-center mb-6 pb-4 border-b border-gray-100">
               
                <h3 class="text-2xl font-bold text-gray-900 bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Add to Order</h3>
            </div>
            
            <form id="addToCartForm" method="POST" class="space-y-6">
                @csrf
                
                <!-- Product Information Card -->
                <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-xl p-5 border border-blue-100">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-600">Product</span>
                            <span id="modalProductName" class="font-bold text-gray-900 text-lg"></span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-600">Price</span>
                            <span class="font-bold text-green-600 text-lg">Frw <span id="modalProductPrice"></span></span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-600">Available</span>
                            <span id="modalProductStock" class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800"></span>
                        </div>
                    </div>
                </div>
                
                <!-- Quantity Input -->
                <div class="space-y-2">
                    <label for="quantity" class="block text-sm font-semibold text-gray-700">Quantity</label>
                    <div class="relative">
                        <input type="number" id="quantity" name="quantity" min="1" value="1" 
                               class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 text-lg font-medium text-center bg-gray-50 hover:bg-white">
                        
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex gap-3 pt-4">
                    <button type="button" onclick="closeAddToCartModal()" 
                            class="flex-1 px-6 py-3 bg-gray-100 text-gray-700  font-medium hover:bg-gray-200 focus:outline-none focus:ring-4 focus:ring-gray-100 transition-all duration-200 transform hover:scale-105">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="flex-1 px-6 py-3 bg-blue-700 text-white  font-medium hover:from-blue-600 hover:to-purple-700 focus:outline-none focus:ring-4 focus:ring-blue-200 transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                        Add to Order
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

    <script>
        // Cart sidebar functionality
        const cartToggle = document.getElementById('cartToggle');
        const cartSidebar = document.getElementById('cartSidebar');
        const closeSidebar = document.getElementById('closeSidebar');
        const cartOverlay = document.getElementById('cartOverlay');

        function openCart() {
            cartSidebar.classList.remove('translate-x-full');
            cartOverlay.classList.remove('hidden');
        }

        function closeCart() {
            cartSidebar.classList.add('translate-x-full');
            cartOverlay.classList.add('hidden');
        }

        cartToggle.addEventListener('click', openCart);
        closeSidebar.addEventListener('click', closeCart);
        cartOverlay.addEventListener('click', closeCart);

        // Add to Cart modal functionality
        function openAddToCartModal(productId, productName, productPrice, productStock) {
            document.getElementById('modalProductName').textContent = productName;
            document.getElementById('modalProductPrice').textContent = productPrice.toFixed(2);
            document.getElementById('modalProductStock').textContent = productStock;
            document.getElementById('quantity').max = productStock;
            document.getElementById('addToCartForm').action = `/products/${productId}/add-to-cart`;
            document.getElementById('addToCartModal').classList.remove('hidden');
        }

        function closeAddToCartModal() {
            document.getElementById('addToCartModal').classList.add('hidden');
        }

        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('.product-row');
            
            rows.forEach(row => {
                const productName = row.querySelector('.product-name').textContent.toLowerCase();
                if (productName.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Close modal when clicking outside
        document.getElementById('addToCartModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeAddToCartModal();
            }
        });

        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('[role="alert"]');
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    </script>
</body>
</html>