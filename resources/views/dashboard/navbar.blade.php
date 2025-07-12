<nav class="bg-white shadow-lg border-b-2 border-red-500">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <div class="flex items-center">
                <!-- Logo with icon -->
                <div class="flex items-center mr-8">
                    <div class="bg-red-500 rounded-lg p-2 mr-3 shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M4 4h2v2H4V4zm0 4h2v2H4V8zm0 4h2v2H4v-2zm0 4h2v2H4v-2zm4-12h12v2H8V4zm0 4h12v2H8V8zm0 4h12v2H8v-2zm0 4h12v2H8v-2z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-red-500 leading-none">HILLS-STOCK</h1>
                        <p class="text-xs text-gray-500 font-medium">Inventory Management</p>
                    </div>
                </div>
                
                <!-- Desktop Navigation -->
                <div class="hidden md:flex space-x-8">
                    <a href="{{ route('dashboard') }}" class="flex items-center font-semibold pb-1 hover:text-red-600 transition-colors {{ request()->routeIs('dashboard') ? 'text-red-500 border-b-2 border-red-500' : 'text-gray-700 hover:text-red-500' }}">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M3 13h1v7c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-7h1a1 1 0 0 0 .707-1.707l-9-9a.999.999 0 0 0-1.414 0l-9 9A1 1 0 0 0 3 13zm7 7v-5h4v5h-4zm2-15.586 6 6V15l.001 5H16v-5c0-1.103-.897-2-2-2h-4c-1.103 0-2 .897-2 2v5H6v-9.586l6-6z"/>
                        </svg>
                        Dashboard
                    </a>
                    <a href="{{ route('products.index') }}" class="flex items-center font-medium pb-1 hover:text-red-600 transition-colors {{ request()->routeIs('products.*') ? 'text-red-500 border-b-2 border-red-500' : 'text-gray-700 hover:text-red-500' }}">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M4 6H2v14c0 1.103.897 2 2 2h14v-2H4V6zm16-4H6c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2V4c0-1.103-.897-2-2-2zM9 12H7v2h2v-2zm0-4H7v2h2V8zm4 4h-2v2h2v-2zm0-4h-2v2h2V8zm4 4h-2v2h2v-2zm0-4h-2v2h2V8z"/>
                        </svg>
                        Products
                    </a>
                  <a href="{{ route('sales.index') }}" class="flex items-center font-medium pb-1 hover:text-red-600 transition-colors {{ request()->routeIs('sales.*') ? 'text-red-500 border-b-2 border-red-500' : 'text-gray-700 hover:text-red-500' }}">
    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
        <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.3 5.4A1 1 0 0 0 6.7 20h10.6a1 1 0 0 0 .97-.76L21 13H7z"/>
        <circle cx="9" cy="21" r="1"/>
        <circle cx="20" cy="21" r="1"/>
    </svg>
    Sales
</a>


    <a href="{{ route('orders.index') }}" class="flex items-center font-medium pb-1 hover:text-red-600 transition-colors {{ request()->routeIs('orders.*') ? 'text-red-500 border-b-2 border-red-500' : 'text-gray-700 hover:text-red-500' }}">
    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
    <path d="M9 2a1 1 0 0 0-1 1v1H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-3V3a1 1 0 0 0-1-1H9zM9 4h6v1H9V4zm0 6h6v2H9v-2zm0 4h6v2H9v-2z"/>
    </svg>
    Customer Orders
</a>




                 <a href="{{ route('reports.index') }}" class="flex items-center font-medium pb-1 hover:text-red-600 transition-colors {{ request()->routeIs('reports.*') ? 'text-red-500 border-b-2 border-red-500' : 'text-gray-700 hover:text-red-500' }}">
    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
        <path d="M3 3v18h18v-2H5V3H3z"/>
        <path d="M7 12h2v7H7v-7zm4-5h2v12h-2V7zm4 2h2v10h-2V9zm4-4h2v14h-2V5z"/>
    </svg>
    Reports
</a>
                    <a href="{{ route('categories.index') }}" class="flex items-center font-medium pb-1 hover:text-red-600 transition-colors {{ request()->routeIs('categories.*') ? 'text-red-500 border-b-2 border-red-500' : 'text-gray-700 hover:text-red-500' }}">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M10 3H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zM9 9H5V5h4v4zm11-6h-6a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zm-1 6h-4V5h4v4zm-9 4H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1zm-1 6H5v-4h4v4zm11-6h-6a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1zm-1 6h-4v-4h4v4z"/>
                        </svg>
                        Categories
                    </a>


                    <a href="{{ route('admin.chat') }}" class="flex items-center font-medium pb-1 hover:text-red-600 transition-colors {{ request()->routeIs('messages.*') ? 'text-red-500 border-b-2 border-red-500' : 'text-gray-700 hover:text-red-500' }}">
    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
        <path d="M2 5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H7l-5 4V5z"/>
    </svg>
    Chat Messages
</a>


                </div>
            </div>
            


            <!-- User Actions -->
            <div class="hidden md:flex items-center space-x-4 relative">
    <!-- Dropdown Trigger: User Icon -->
    <button id="userMenuButton" class="flex items-center text-gray-600 focus:outline-none">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v3h20v-3c0-3.3-6.7-5-10-5z"/>
        </svg>
    </button>

    <!-- Dropdown Menu -->
    <div id="userDropdown" class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg hidden z-50">
        <div class="p-3 text-sm text-gray-700 border-b">{{ auth()->user()->name }}</div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-100 hover:text-red-700">
                Logout
            </button>
        </form>
    </div>
</div>

        
        <!-- Mobile Menu -->
        <div class="md:hidden pb-4">
            <div class="flex flex-col space-y-3">
                <a href="{{ route('dashboard') }}" class="flex items-center text-red-500 font-semibold hover:text-red-600 transition-colors py-2">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3 13h1v7c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-7h1a1 1 0 0 0 .707-1.707l-9-9a.999.999 0 0 0-1.414 0l-9 9A1 1 0 0 0 3 13zm7 7v-5h4v5h-4zm2-15.586 6 6V15l.001 5H16v-5c0-1.103-.897-2-2-2h-4c-1.103 0-2 .897-2 2v5H6v-9.586l6-6z"/>
                    </svg>
                    Dashboard
                </a>
                <a href="{{ route('products.index') }}" class="flex items-center text-gray-700 hover:text-red-500 transition-colors py-2">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M4 6H2v14c0 1.103.897 2 2 2h14v-2H4V6zm16-4H6c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2V4c0-1.103-.897-2-2-2zM9 12H7v2h2v-2zm0-4H7v2h2V8zm4 4h-2v2h2v-2zm0-4h-2v2h2V8zm4 4h-2v2h2v-2zm0-4h-2v2h2V8z"/>
                    </svg>
                    Products
                </a>
                <a href="{{ route('sales.index') }}" class="flex items-center text-gray-700 hover:text-red-500 transition-colors py-2">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M21.822 7.431A1 1 0 0 0 21 7H7.333L6.179 4.23A1.994 1.994 0 0 0 4.333 3H2v2h2.333l4.744 11.385A1 1 0 0 0 10 17h8c.417 0 .79-.259.937-.648l3-8a1 1 0 0 0-.115-.921zM17.307 15h-6.64l-2.5-6h11.39l-2.25 6z"/>
                        <circle cx="10.5" cy="19.5" r="1.5"/>
                        <circle cx="17.5" cy="19.5" r="1.5"/>
                    </svg>
                    Sales
                </a>
                <a href="{{ route('categories.index') }}" class="flex items-center text-gray-700 hover:text-red-500 transition-colors py-2">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M10 3H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zM9 9H5V5h4v4zm11-6h-6a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zm-1 6h-4V5h4v4zm-9 4H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-6a1 1 0 0-1-1zm-1 6H5v-4h4v4zm11-6h-6a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1zm-1 6h-4v-4h4v4z"/>
                    </svg>
                    Categories
                </a>
            </div>
        </div>
    </div>
</nav>