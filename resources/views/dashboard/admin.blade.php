<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Navbar -->
    @include('dashboard.navbar')

    <!-- Main Dashboard -->
    <div class="max-w-7xl mx-auto p-6 space-y-6">
        <h2 class="text-2xl font-bold text-gray-800">Dashboard Overview</h2>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white border-l-4 border-blue-500 shadow-lg rounded-lg p-6 hover:shadow-xl transition-shadow">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-medium text-gray-600">Total Products</h3>
                        <p class="text-2xl font-bold text-gray-800">{{ number_format($totalProducts) }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white border-l-4 border-green-500 shadow-lg rounded-lg p-6 hover:shadow-xl transition-shadow">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-medium text-gray-600">Total Sales</h3>
                        <p class="text-2xl font-bold text-green-600">Frw {{ number_format($totalSales, 2) }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white border-l-4 border-purple-500 shadow-lg rounded-lg p-6 hover:shadow-xl transition-shadow">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-100 text-purple-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-medium text-gray-600">Total Orders</h3>
                        <p class="text-2xl font-bold text-gray-800">{{ number_format($totalOrders) }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white border-l-4 border-yellow-500 shadow-lg rounded-lg p-6 hover:shadow-xl transition-shadow">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 text-yellow-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-medium text-gray-600">Low Stock Alert</h3>
                        <p class="text-2xl font-bold text-yellow-600">{{ $lowStockCount }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Secondary Stats -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white shadow rounded-lg p-4">
                <h3 class="text-gray-600 text-sm">Categories</h3>
                <p class="text-xl font-bold text-gray-800">{{ $totalCategories }}</p>
            </div>
            <div class="bg-white shadow rounded-lg p-4">
                <h3 class="text-gray-600 text-sm">Pending Orders</h3>
                <p class="text-xl font-bold text-orange-600">{{ $pendingOrders }}</p>
            </div>
            <div class="bg-white shadow rounded-lg p-4">
                <h3 class="text-gray-600 text-sm">Completed Orders</h3>
                <p class="text-xl font-bold text-green-600">{{ $completedOrders }}</p>
            </div>
            <div class="bg-white shadow rounded-lg p-4">
                <h3 class="text-gray-600 text-sm">Total Customers</h3>
                <p class="text-xl font-bold text-blue-600">{{ $totalCustomers }}</p>
            </div>
        </div>

        <!-- Charts and Tables Row -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Activities -->
            <div class="bg-white shadow-lg rounded-lg border-l-4 border-indigo-500 p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    Recent Activities
                </h3>
                @if($recentActivities->count() > 0)
                    <div class="space-y-3 max-h-80 overflow-y-auto">
                        @foreach($recentActivities as $activity)
                            <div class="flex items-start space-x-3 p-3 bg-gray-50 rounded-lg">
                                <span class="text-lg">{{ $activity['icon'] }}</span>
                                <div class="flex-1">
                                    <p class="text-sm text-gray-700">{{ $activity['message'] }}</p>
                                    <p class="text-xs text-gray-500 mt-1">{{ $activity['time']->diffForHumans() }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-center py-8">No recent activities</p>
                @endif
            </div>

            <!-- Low Stock Products -->
            <div class="bg-white shadow-lg rounded-lg border-l-4 border-red-500 p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                    Low Stock Products
                </h3>
                @if($lowStockProducts->count() > 0)
                    <div class="space-y-3 max-h-80 overflow-y-auto">
                        @foreach($lowStockProducts as $product)
                            <div class="flex justify-between items-center p-3 bg-red-50 rounded-lg border-l-2 border-red-300">
                                <div>
                                    <p class="font-medium text-gray-800">{{ $product->name }}</p>
                                    <p class="text-sm text-gray-600">SKU: {{ $product->sku ?? 'N/A' }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-lg font-bold text-red-600">{{ $product->total_quantity }}</p>
                                    <p class="text-xs text-gray-500">Min: {{ $product->min_stock }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-center py-8">All products are well-stocked!</p>
                @endif
            </div>
        </div>

        <!-- Recent Sales Table -->
        @if(isset($recentSales) && $recentSales->count() > 0)
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 00-2-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                Recent Sales
            </h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Invoice</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($recentSales as $sale)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $sale->invoice_number }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $sale->customer_name ?? 'Walk-in Customer' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $sale->quantity }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-600">
                                Frw {{ number_format($sale->total_price, 2) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $sale->created_at->format('M d, Y') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>

</body>
</html>