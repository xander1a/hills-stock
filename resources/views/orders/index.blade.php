<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Orders - Inventory System</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Navbar -->
    @include('dashboard.navbar')

    <div class="min-h-screen bg-white py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Page Heading -->
            <div class="mb-6 border-b border-red-500 pb-4">
                <h1 class="text-3xl font-bold text-red-600">Orders Management</h1>
                <p class="text-gray-600">View and manage customer orders</p>
            </div>

            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Filters -->
            <div class="bg-white shadow rounded-lg mb-6 p-6 border border-red-200">
                <form method="GET" action="{{ route('orders.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                        <input type="text" name="search" value="{{ request('search') }}" 
                               placeholder="Order ID, Customer name, email..." 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500">
                            <option value="">All Statuses</option>
                            @foreach($statusOptions as $value => $label)
                                <option value="{{ $value }}" {{ request('status') == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Date From</label>
                        <input type="date" name="date_from" value="{{ request('date_from') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Date To</label>
                        <input type="date" name="date_to" value="{{ request('date_to') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500">
                    </div>
                    
                    <div class="md:col-span-4 flex gap-2">
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition-colors">
                            <i class="fas fa-search mr-2"></i>Filter
                        </button>
                        <a href="{{ route('orders.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition-colors">
                            <i class="fas fa-times mr-2"></i>Clear
                        </a>
                    </div>
                </form>
            </div>

            <!-- Orders Summary -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-blue-100 p-4 rounded-lg border border-blue-200">
                    <h3 class="text-lg font-semibold text-blue-800">Total Orders</h3>
                    <p class="text-2xl font-bold text-blue-600">{{ $orders->total() }}</p>
                </div>
                <div class="bg-yellow-100 p-4 rounded-lg border border-yellow-200">
                    <h3 class="text-lg font-semibold text-yellow-800">Pending</h3>
                    <p class="text-2xl font-bold text-yellow-600">{{ $orders->where('status', 'pending')->count() }}</p>
                </div>
                <div class="bg-green-100 p-4 rounded-lg border border-green-200">
                    <h3 class="text-lg font-semibold text-green-800">Delivered</h3>
                    <p class="text-2xl font-bold text-green-600">{{ $orders->where('status', 'delivered')->count() }}</p>
                </div>
                <div class="bg-red-100 p-4 rounded-lg border border-red-200">
                    <h3 class="text-lg font-semibold text-red-800">Cancelled</h3>
                    <p class="text-2xl font-bold text-red-600">{{ $orders->where('status', 'cancelled')->count() }}</p>
                </div>
            </div>

            <!-- Orders Table -->
            <div class="bg-white shadow rounded-lg overflow-hidden border border-red-200">
                @if($orders->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-red-200">
                            <thead class="bg-red-500 text-white">
                                <tr>
                                    <th class="px-6 py-3 text-left text-sm font-semibold">Order ID</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold">Customer Info</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold">Items</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold">Status</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold">Total</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold">Date</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($orders as $order)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">#{{ $order->id }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $order->customer_name }}</div>
                                            <div class="text-sm text-gray-600">{{ $order->customer_email }}</div>
                                            @if($order->customer_phone)
                                                <div class="text-sm text-gray-600">{{ $order->customer_phone }}</div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900">
                                                {{ $order->orderItems->count() }} item(s)
                                            </div>
                                            <div class="text-xs text-gray-500">
                                                Total Qty: {{ $order->orderItems->sum('quantity') }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <form method="POST" action="{{ route('orders.update-status', $order->id) }}" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <select name="status" onchange="this.form.submit()" 
                                                        class="text-xs px-2 py-1 rounded-full border-0 focus:ring-2 focus:ring-red-500
                                                        {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                        {{ $order->status === 'confirmed' ? 'bg-blue-100 text-blue-800' : '' }}
                                                        {{ $order->status === 'processing' ? 'bg-purple-100 text-purple-800' : '' }}
                                                        {{ $order->status === 'shipped' ? 'bg-indigo-100 text-indigo-800' : '' }}
                                                        {{ $order->status === 'delivered' ? 'bg-green-100 text-green-800' : '' }}
                                                        {{ $order->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                                    @foreach($statusOptions as $value => $label)
                                                        <option value="{{ $value }}" {{ $order->status === $value ? 'selected' : '' }}>
                                                            {{ $label }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </form>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-semibold text-gray-900">${{ number_format($order->total_amount, 2) }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $order->created_at->format('M d, Y') }}</div>
                                            <div class="text-xs text-gray-500">{{ $order->created_at->format('h:i A') }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('orders.show', $order->id) }}" 
                                                   class="text-blue-600 hover:text-blue-900 transition-colors" 
                                                   title="View Details">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                
                                                <form method="POST" action="{{ route('orders.destroy', $order->id) }}" 
                                                      class="inline" 
                                                      onsubmit="return confirm('Are you sure you want to delete this order?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="text-red-600 hover:text-red-900 transition-colors" 
                                                            title="Delete Order">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                        {{ $orders->appends(request()->query())->links() }}
                    </div>
                @else
                    <div class="text-center py-12">
                        <i class="fas fa-shopping-cart text-gray-400 text-6xl mb-4"></i>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">No orders found</h3>
                        <p class="text-gray-600">No orders match your current filters.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        // Auto-refresh page every 30 seconds for real-time updates
        setTimeout(function(){
            window.location.reload();
        }, 30000);
    </script>
</body>
</html>