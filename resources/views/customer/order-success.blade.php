@extends('customer.navbar')

@section('title', 'Order Confirmed')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Success Message -->
        <div class="text-center mb-8">
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 mb-4">
                <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Order Confirmed!</h1>
            <p class="text-lg text-gray-600">Thank you for your order. We'll process it shortly.</p>
        </div>

        <!-- Order Details -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-4 bg-red-50 border-b">
                <h2 class="text-xl font-semibold text-gray-800">Order Details</h2>
            </div>
            
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Order Info -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Order Information</h3>
                        <div class="space-y-2">
                            <p><span class="font-medium text-gray-600">Order ID:</span> #{{ $order->id }}</p>
                            <p><span class="font-medium text-gray-600">Date:</span> {{ $order->created_at->format('M d, Y') }}</p>
                            <p><span class="font-medium text-gray-600">Status:</span> 
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </p>
                            <p><span class="font-medium text-gray-600">Total:</span> 
                                <span class="text-lg font-bold text-red-600">${{ number_format($order->total_amount, 2) }}</span>
                            </p>
                        </div>
                    </div>
                    
                    <!-- Customer Info -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Customer Information</h3>
                        <div class="space-y-2">
                            <p><span class="font-medium text-gray-600">Name:</span> {{ $order->customer_name }}</p>
                            <p><span class="font-medium text-gray-600">Email:</span> {{ $order->customer_email }}</p>
                            @if($order->customer_phone)
                                <p><span class="font-medium text-gray-600">Phone:</span> {{ $order->customer_phone }}</p>
                            @endif
                            <p><span class="font-medium text-gray-600">Address:</span></p>
                            <p class="text-gray-800 ml-4">{{ $order->customer_address }}</p>
                        </div>
                    </div>
                </div>
                
                @if($order->notes)
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Order Notes</h3>
                        <p class="text-gray-700 bg-gray-50 p-3 rounded">{{ $order->notes }}</p>
                    </div>
                @endif
                
                <!-- Order Items -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Order Items</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SKU</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($order->orderItems as $item)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $item->product_name }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $item->product_sku ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            ${{ number_format($item->unit_price, 2) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $item->quantity }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            ${{ number_format($item->total_price, 2) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-gray-50">
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-right text-sm font-medium text-gray-900">
                                        Total Amount:
                                    </td>
                                    <td class="px-6 py-4 text-sm font-bold text-red-600">
                                        ${{ number_format($order->total_amount, 2) }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Next Steps -->
        <div class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-6">
            <h3 class="text-lg font-semibold text-blue-900 mb-3">What's Next?</h3>
            <div class="space-y-2 text-blue-800">
                <p>• We'll send you an email confirmation shortly</p>
                <p>• Your order will be processed within 1-2 business days</p>
                <p>• You'll receive updates about your order status via email</p>
                <p>• Our team will contact you before delivery</p>
            </div>
        </div>
        
        <!-- Action Buttons -->
        <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('customer.products') }}" 
               class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-semibold text-center transition-colors">
                Continue Shopping
            </a>
            <button onclick="window.print()" 
                    class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors">
                Print Order
            </button>
        </div>
    </div>
</div>
@endsection