<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order #{{ $order->id }} - Inventory System</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Navbar -->
    @include('dashboard.navbar')

    <div class="min-h-screen bg-white py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Page Heading -->
            <div class="mb-6 flex justify-between items-center border-b border-red-500 pb-4">
                <div>
                    <h1 class="text-3xl font-bold text-red-600">Order #{{ $order->id }}</h1>
                    <p class="text-gray-600">Order placed on {{ $order->created_at->format('F d, Y \a\t h:i A') }}</p>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('orders.index') }}" 
                       class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i>Back to Orders
                    </a>
                    <button onclick="window.print()" 
                            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition-colors">
                        <i class="fas fa-print mr-2"></i>Print
                    </button>
                </div>
            </div>

            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Order Summary -->
                <div class="lg:col-span-2">
                    <!-- Customer Information -->
                    <div class="bg-white shadow rounded-lg mb-6 border border-red-200">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Customer Information</h3>
                        </div>
                        <div class="px-6 py-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Name</label>
                                    <p class="text-sm text-gray-900 font-semibold">{{ $order->customer_name }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Email</label>
                                    <p class="text-sm text-gray-900">{{ $order->customer_email }}</p>
                                </div>
                                @if($order->customer_phone)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Phone</label>
                                        <p class="text-sm text-gray-900">{{ $order->customer_phone }}</p>
                                    </div>
                                @endif
                                @if($order->customer_address)
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700">Address</label>
                                        <p class="text-sm text-gray-900">{{ $order->customer_address }}</p>
                                    </div>
                                @endif
                                @if($order->notes)
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700">Order Notes</label>
                                        <p class="text-sm text-gray-900 bg-gray-50 p-3 rounded">{{ $order->notes }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Order Items -->
                    <div class="bg-white shadow rounded-lg border border-red-200">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Order Items</h3>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SKU</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unit Price</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($order->orderItems as $item)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    @if($item->product && $item->product->image_path)
                                                        <img class="h-12 w-12 rounded-lg object-cover mr-4" 
                                                             src="{{ asset('storage/' . $item->product->image_path) }}" 
                                                             alt="{{ $item->product_name }}">
                                                    @else
                                                        <div class="h-12 w-12 bg-gray-200 rounded-lg mr-4 flex items-center justify-center">
                                                            <i class="fas fa-image text-gray-400"></i>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900">{{ $item->product_name }}</div>
                                                        @if($item->product)
                                                            <div class="text-sm text-gray-500">
                                                                Stock: {{ $item->product->total_quantity }} available
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $item->product_sku ?? 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                ${{ number_format($item->unit_price, 2) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $item->quantity }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                                ${{ number_format($item->total_price, 2) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Order Status and Summary -->
                <div class="space-y-6">
                    <!-- Status Update -->
                    <div class="bg-white shadow rounded-lg border border-red-200">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Order Status</h3>
                        </div>
                        <div class="px-6 py-4">
                            <form method="POST" action="{{ route('orders.update-status', $order->id) }}">
                                @csrf
                                @method('PATCH')
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Current Status</label>
                                    <select name="status" 
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500">
                                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="confirmed" {{ $order->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                        <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                                        <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                                        <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </div>
                                <button type="submit" 
                                        class="w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded transition-colors">
                                    Update Status
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="bg-white shadow rounded-lg border border-red-200">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Order Summary</h3>
                        </div>
                        <div class="px-6 py-4 space-y-3">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Total Items:</span>
                                <span class="font-medium">{{ $order->orderItems->count() }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Total Quantity:</span>
                                <span class="font-medium">{{ $order->orderItems->sum('quantity') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Subtotal:</span>
                                <span class="font-medium">${{ number_format($order->orderItems->sum('total_price'), 2) }}</span>
                            </div>
                            <div class="border-t border-gray-200 pt-3">
                                <div class="flex justify-between text-lg font-semibold">
                                    <span class="text-gray-900">Total Amount:</span>
                                    <span class="text-red-600">${{ number_format($order->total_amount, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order Timeline -->
                    <div class="bg-white shadow rounded-lg border border-red-200">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Order Timeline</h3>
                        </div>
                        <div class="px-6 py-4">
                            <div class="space-y-3">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-green-500 rounded-full mr-3"></div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Order Placed</p>
                                        <p class="text-xs text-gray-500">{{ $order->created_at->format('M d, Y h:i A') }}</p>
                                    </div>
                                </div>
                                
                                @if($order->status !== 'pending')
                                    <div class="flex items-center">
                                        <div class="w-3 h-3 bg-blue-500 rounded-full mr-3"></div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">Status: {{ ucfirst($order->status) }}</p>
                                            <p class="text-xs text-gray-500">{{ $order->updated_at->format('M d, Y h:i A') }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-white shadow rounded-lg border border-red-200">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Quick Actions</h3>
                        </div>
                        <div class="px-6 py-4 space-y-3">
                            <a href="mailto:{{ $order->customer_email }}" 
                               class="w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition-colors inline-block text-center">
                                <i class="fas fa-envelope mr-2"></i>Email Customer
                            </a>
                            
                            @if($order->customer_phone)
                                <a href="tel:{{ $order->customer_phone }}" 
                                   class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded transition-colors inline-block text-center">
                                    <i class="fas fa-phone mr-2"></i>Call Customer
                                </a>
                            @endif
                            
                            <form method="POST" action="{{ route('orders.destroy', $order->id) }}" 
                                  onsubmit="return confirm('Are you sure you want to delete this order? This action cannot be undone.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded transition-colors">
                                    <i class="fas fa-trash mr-2"></i>Delete Order
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Print Styles -->
    <style>
        @media print {
            .no-print {
                display: none !important;
            }
            
            body {
                background: white !important;
            }
            
            .shadow {
                box-shadow: none !important;
            }
        }
    </style>
</body>
</html>