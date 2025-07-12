@extends('customer.navbar')

@section('title', 'Checkout')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b-2 border-red-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <h1 class="text-3xl font-bold text-red-600">Checkout</h1>
                <a href="{{ route('customer.cart') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors">
                    Back to Cart
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
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

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Checkout Form -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-6">Customer Information</h2>
                
                <form action="{{ route('customer.order.place') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                        <input type="text" id="customer_name" name="customer_name" value="{{ old('customer_name') }}" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent @error('customer_name') border-red-500 @enderror">
                        @error('customer_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="customer_email" class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                        <input type="email" id="customer_email" name="customer_email" value="{{ old('customer_email') }}" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent @error('customer_email') border-red-500 @enderror">
                        @error('customer_email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="customer_phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                        <input type="tel" id="customer_phone" name="customer_phone" value="{{ old('customer_phone') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent @error('customer_phone') border-red-500 @enderror">
                        @error('customer_phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="customer_address" class="block text-sm font-medium text-gray-700 mb-2">Delivery Address *</label>
                        <textarea id="customer_address" name="customer_address" rows="4" required
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent @error('customer_address') border-red-500 @enderror">{{ old('customer_address') }}</textarea>
                        @error('customer_address')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Order Notes (Optional)</label>
                        <textarea id="notes" name="notes" rows="3" placeholder="Any special instructions for your order..."
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent @error('notes') border-red-500 @enderror">{{ old('notes') }}</textarea>
                        @error('notes')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <button type="submit" 
                            class="w-full bg-red-600 hover:bg-red-700 text-white py-3 px-4 rounded-lg font-semibold text-lg transition-colors">
                        Place Order
                    </button>
                </form>
            </div>
            
            <!-- Order Summary -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-6">Order Summary</h2>
                
                <div class="space-y-4 mb-6">
                    @foreach($cart as $id => $item)
                        <div class="flex items-center space-x-4 pb-4 border-b border-gray-200">
                            <div class="flex-shrink-0 w-12 h-12 bg-gray-200 rounded-md flex items-center justify-center">
                                @if($item['image_path'])
                                    <img src="{{ asset('storage/' . $item['image_path']) }}" 
                                         alt="{{ $item['name'] }}" 
                                         class="w-full h-full object-cover rounded-md">
                                @else
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                @endif
                            </div>
                            
                            <div class="flex-1">
                                <h4 class="font-medium text-gray-800">{{ $item['name'] }}</h4>
                                <p class="text-sm text-gray-600">Qty: {{ $item['quantity'] }}</p>
                            </div>
                            
                            <div class="text-right">
                                <p class="font-semibold text-gray-800">${{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Subtotal</span>
                        <span class="font-semibold">${{ number_format($total, 2) }}</span>
                    </div>
                    
                    <div class="flex justify-between">
                        <span class="text-gray-600">Shipping</span>
                        <span class="font-semibold">Free</span>
                    </div>
                    
                    <div class="flex justify-between">
                        <span class="text-gray-600">Tax</span>
                        <span class="font-semibold">$0.00</span>
                    </div>
                    
                    <div class="border-t pt-3">
                        <div class="flex justify-between">
                            <span class="text-lg font-semibold text-gray-800">Total</span>
                            <span class="text-lg font-bold text-red-600">${{ number_format($total, 2) }}</span>
                        </div>
                    </div>
                </div>
                
                <!-- Payment Info -->
                <div class="mt-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-yellow-600 mt-0.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                        <div>
                            <h4 class="text-sm font-medium text-yellow-800">Payment Information</h4>
                            <p class="text-sm text-yellow-700 mt-1">Payment will be collected upon delivery. We accept cash and mobile payments.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection