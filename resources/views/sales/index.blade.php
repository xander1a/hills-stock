<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sales - Inventory System</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Navbar -->
 @include('dashboard.navbar')

    <!-- Content -->
    <div class="max-w-7xl mx-auto p-6">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Recent Sales</h2>

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
                    id="salesSearchInput" 
                    placeholder="Search by product name, customer, or seller..." 
                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-red-500 focus:border-red-500 text-sm font-medium"
                >
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md border-2 border-red-500 rounded">
                <thead class="bg-red-500 text-white">
                    <tr>
                        <th class="py-2 px-4 text-left">#</th>
                        <th class="py-2 px-4 text-left">Product</th>
                        <th class="py-2 px-4 text-left">Customer</th>
                        <th class="py-2 px-4 text-left">Payment Method</th>
                        <th class="py-2 px-4 text-left">Discount</th>
                        <th class="py-2 px-4 text-left">Seller</th>
                        <th class="py-2 px-4 text-left">Quantity</th>
                        <th class="py-2 px-4 text-left">Total Price</th>
                        <th class="py-2 px-4 text-left">Date</th>
                    </tr>
                </thead>
                <tbody class="text-gray-800" id="salesTableBody">
                    @foreach($sales as $index => $sale)
                        <tr class="border-b hover:bg-gray-100 sales-row">
                            <td class="py-2 px-4">{{ $index + 1 }}</td>
                            <td class="py-2 px-4 product-name">{{ $sale->product->name }}</td>
                            <td class="py-2 px-4 customer-name">{{ $sale->customer_name }}</td>
                            <td class="py-2 px-4">{{ $sale->payment_method }}</td>
                            <td class="py-2 px-4">{{ $sale->discount }}%</td>
                            <td class="py-2 px-4 seller-name">{{ $sale->user->name }}</td>
                            <td class="py-2 px-4">{{ $sale->quantity }}</td>
                            <td class="py-2 px-4">Frw {{ number_format($sale->total_price, 2) }}</td>
                            <td class="py-2 px-4">{{ $sale->created_at->format('d M Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- No Results Message -->
        <div id="noResultsMessage" class="hidden text-center py-8">
            <div class="text-gray-500">
                <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No sales found</h3>
                <p class="text-gray-500">Try adjusting your search terms</p>
            </div>
        </div>
    </div>

    <script>
        // Search functionality for sales
        document.getElementById('salesSearchInput').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('.sales-row');
            const noResultsMessage = document.getElementById('noResultsMessage');
            let visibleRows = 0;
            
            rows.forEach(row => {
                const productName = row.querySelector('.product-name').textContent.toLowerCase();
                const customerName = row.querySelector('.customer-name').textContent.toLowerCase();
                const sellerName = row.querySelector('.seller-name').textContent.toLowerCase();
                
                // Search in product name, customer name, or seller name
                if (productName.includes(searchTerm) || 
                    customerName.includes(searchTerm) || 
                    sellerName.includes(searchTerm)) {
                    row.style.display = '';
                    visibleRows++;
                } else {
                    row.style.display = 'none';
                }
            });

            // Show/hide no results message
            if (visibleRows === 0 && searchTerm.length > 0) {
                noResultsMessage.classList.remove('hidden');
            } else {
                noResultsMessage.classList.add('hidden');
            }
        });
    </script>
</body>
</html>