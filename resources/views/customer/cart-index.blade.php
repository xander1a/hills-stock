@extends('customer.navbar')

@section('title', 'Shopping Cart')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header with Continue Shopping Button -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Shopping Cart</h1>
                <p class="text-gray-600 mt-1">Review your items before checkout</p>
            </div>
            <a href="{{ route('customer.products') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg transition-colors font-medium shadow-sm">
                Continue Shopping
            </a>
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

        @if(count($cart) > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Cart Items -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="px-6 py-4 bg-red-50 border-b">
                            <h2 class="text-lg font-semibold text-gray-800">Cart Items</h2>
                        </div>
                        
                        <div class="divide-y divide-gray-200">
                            @foreach($cart as $id => $item)
                                <div class="p-6">
                                    <div class="flex items-center space-x-4">
                                        <!-- Product Image -->
                                        <div class="flex-shrink-0 w-16 h-16 bg-gray-200 rounded-md flex items-center justify-center">
                                            @if($item['image_path'])
                                                <img src="{{ asset('storage/' . $item['image_path']) }}" 
                                                     alt="{{ $item['name'] }}" 
                                                     class="w-full h-full object-cover rounded-md">
                                            @else
                                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2-2v12a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                            @endif
                                        </div>
                                        
                                        <!-- Product Details -->
                                        <div class="flex-1">
                                            <h3 class="text-lg font-semibold text-gray-800">{{ $item['name'] }}</h3>
                                            @if($item['sku'])
                                                <p class="text-sm text-gray-500">SKU: {{ $item['sku'] }}</p>
                                            @endif
                                            <p class="text-lg font-bold text-red-600">${{ number_format($item['price'], 2) }}</p>
                                        </div>
                                        
                                        <!-- Quantity Controls -->
                                        <div class="flex items-center space-x-3">
                                            <form action="{{ route('customer.cart.update') }}" method="POST" class="flex items-center space-x-2">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $id }}">
                                                <label class="text-sm font-medium text-gray-700">Qty:</label>
                                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" 
                                                       min="1" max="99"
                                                       class="w-16 px-2 py-1 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
                                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-md text-sm transition-colors">
                                                    Update
                                                </button>
                                            </form>
                                        </div>
                                        
                                        <!-- Remove Button -->
                                        <div>
                                            <form action="{{ route('customer.cart.remove') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $id }}">
                                                <button type="submit" class="text-red-600 hover:text-red-800 transition-colors p-2 rounded-md hover:bg-red-50">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    
                                    <!-- Item Total -->
                                    <div class="mt-4 text-right">
                                        <span class="text-lg font-semibold text-gray-800">
                                            Subtotal: ${{ number_format($item['price'] * $item['quantity'], 2) }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                
                <!-- Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-md p-6 sticky top-8">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Order Summary</h2>
                        
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Items ({{ count($cart) }})</span>
                                <span class="font-semibold">${{ number_format($total, 2) }}</span>
                            </div>
                            
                            <div class="flex justify-between">
                                <span class="text-gray-600">Shipping</span>
                                <span class="font-semibold text-green-600">Free</span>
                            </div>
                            
                            <div class="border-t pt-3">
                                <div class="flex justify-between">
                                    <span class="text-lg font-semibold text-gray-800">Total</span>
                                    <span class="text-lg font-bold text-red-600">${{ number_format($total, 2) }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-6">
                            <a href="{{ route('customer.checkout') }}" 
                               class="w-full bg-red-600 hover:bg-red-700 text-white py-3 px-4 rounded-lg font-semibold text-center block transition-colors shadow-sm">
                                Proceed to Checkout
                            </a>
                        </div>
                        
                        <!-- Additional Continue Shopping Button -->
                        <div class="mt-3">
                            <a href="{{ route('customer.products') }}" 
                               class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 py-2 px-4 rounded-lg font-medium text-center block transition-colors border border-gray-300">
                                Continue Shopping
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-16 bg-white rounded-lg shadow-sm">
                <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5-6m9.5 6v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01">
                    </path>
                </svg>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Your cart is empty</h3>
                <p class="text-gray-500 mb-6">Start adding some products to your cart to get started.</p>
                <a href="{{ route('customer.products') }}" 
                   class="inline-flex items-center bg-red-600 hover:bg-red-700 text-white px-8 py-3 rounded-lg font-semibold transition-colors shadow-sm">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    Shop Now
                </a>
            </div>
        @endif
    </div>
</div>
@endsection