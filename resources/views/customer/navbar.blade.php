<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Product Store')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg border-b-2 border-red-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('customer.products') }}" class="text-2xl font-bold text-red-600 hover:text-red-700 transition-colors">
                       XI-STOCK
                    </a>
                </div>
                
                <div class="flex items-center space-x-6">
                    <a href="{{ route('customer.products') }}" 
                       class="text-gray-700 hover:text-red-600 px-3 py-2 rounded-md font-medium transition-colors">
                        Products
                    </a>

                    @if(Auth::check())
                      <a href="{{ route('user.chat') }}" 
                       class="text-gray-700 hover:text-red-600 px-3 py-2 rounded-md font-medium transition-colors">
                       Chat
                    </a>
                    @endif

                    <a href="{{ route('customer.cart') }}" 
                       class="relative text-gray-700 hover:text-red-600 px-3 py-2 rounded-md font-medium transition-colors">
                        <svg class="w-6 h-6 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17M17 13v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"></path>
                        </svg>
                        Cart
                        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                            {{ session('cart') ? count(session('cart')) : 0 }}
                        </span>
                    </a>
                    
                    <a href="{{ route('customer.checkout') }}" 
                       class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md font-medium transition-colors">
                        Checkout
                    </a>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button class="mobile-menu-button text-gray-700 hover:text-red-600 focus:outline-none focus:text-red-600" onclick="toggleMobileMenu()">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="mobile-menu hidden md:hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-white border-t border-gray-200">
                <a href="{{ route('customer.products') }}" 
                   class="text-gray-700 hover:text-red-600 block px-3 py-2 rounded-md text-base font-medium">
                    Products
                </a>
                <a href="{{ route('customer.cart') }}" 
                   class="text-gray-700 hover:text-red-600 block px-3 py-2 rounded-md text-base font-medium">
                    Cart ({{ session('cart') ? count(session('cart')) : 0 }})
                </a>
                <a href="{{ route('customer.checkout') }}" 
                   class="text-gray-700 hover:text-red-600 block px-3 py-2 rounded-md text-base font-medium">
                    Checkout
                </a>
            </div>
        </div>
    </nav>

    <script>
        function toggleMobileMenu() {
            const mobileMenu = document.querySelector('.mobile-menu');
            mobileMenu.classList.toggle('hidden');
        }
    </script>

    @yield('content')
</body>
</html>         