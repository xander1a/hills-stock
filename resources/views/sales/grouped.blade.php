<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales History</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        .status-button {
            transition: all 0.3s ease;
        }
        .status-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">
    @include('dashboard.navbar')
    
    <div class="max-w-7xl mx-auto p-6">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800">Sales History</h2>
            <a href="{{ route('products.index') }}" class="bg-blue-500 text-white px-6 py-3 rounded hover:bg-blue-600 transition-colors">
                Back to Products
            </a>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

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
                    id="salesHistorySearchInput" 
                    placeholder="Search by product name, customer, phone, or notes..." 
                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm font-medium"
                >
            </div>
        </div>

        <div class="bg-white shadow-lg rounded-lg overflow-hidden" id="salesHistoryContainer">
            @if($groupedSales->isEmpty())
                <div class="p-8 text-center text-gray-500">
                    <p>No sales history found.</p>
                </div>
            @else
                @foreach($groupedSales as $sessionId => $sessionSales)
                    <div class="border-b border-gray-200 last:border-b-0 sale-session" 
                         data-customer-name="{{ strtolower($sessionSales->first()->customer_name ?? '') }}"
                         data-customer-phone="{{ strtolower($sessionSales->first()->customer_phone ?? '') }}"
                         data-notes="{{ strtolower($sessionSales->first()->notes ?? '') }}"
                         data-products="{{ strtolower($sessionSales->pluck('product.name')->implode(' ')) }}">
                        <div class="bg-gray-50 px-6 py-4 border-b">
                            <div class="flex justify-between items-center flex-wrap">
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-gray-800">Sale Frw {{ substr($sessionId, -8) }}</h3>
                                    <p class="text-sm text-gray-600">
                                        Date: {{ $sessionSales->first()->sale_date ? $sessionSales->first()->sale_date->format('M j, Y g:i A') : 'Not set' }}
                                        @if($sessionSales->first()->customer_name)
                                            | Customer: <span class="customer-name">{{ $sessionSales->first()->customer_name }}</span>
                                        @endif
                                        @if($sessionSales->first()->customer_phone)
                                            | Phone: <span class="customer-phone">{{ $sessionSales->first()->customer_phone }}</span>
                                        @endif
                                    </p>
                                    @if($sessionSales->first()->notes)
                                        <p class="text-sm text-gray-600 mt-1">Notes: <span class="sale-notes">{{ $sessionSales->first()->notes }}</span></p>
                                    @endif
                                </div>
                                
                                <div class="flex items-center space-x-4 mt-4 md:mt-0">
                                    <!-- Status Badge -->
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                        {{ $sessionSales->first()->status === 'completed' ? 'bg-green-100 text-green-800' : 
                                           ($sessionSales->first()->status === 'failed' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                        {{ ucfirst($sessionSales->first()->status) }}
                                    </span>
                                    
                                    <!-- Total Price -->
                                    <p class="text-lg font-bold text-gray-800">
                                        Total: Frw {{ number_format($sessionSales->sum('total_price'), 2) }}
                                    </p>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex flex-wrap gap-3 mt-4">
                                @if($sessionSales->first()->status === 'completed')
                                    <!-- Only show PDF download button when status is completed -->
                                    <a href="{{ route('sales.downloadPDF', $sessionId) }}" 
                                       class="status-button bg-blue-500 text-white px-4 py-2 rounded text-sm hover:bg-blue-600 transition-colors inline-flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        Download PDF
                                    </a>
                                @else
                                    <!-- Show all status update buttons when status is not completed -->
                                    @if($sessionSales->first()->status !== 'pending')
                                        <form action="{{ route('sales.updateStatus', $sessionId) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="pending">
                                            <button type="submit" class="status-button bg-yellow-500 text-white px-4 py-2 rounded text-sm hover:bg-yellow-600 transition-colors">
                                                Mark as Pending
                                            </button>
                                        </form>
                                    @endif

                                    <form action="{{ route('sales.updateStatus', $sessionId) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="completed">
                                        <button type="submit" class="status-button bg-green-500 text-white px-4 py-2 rounded text-sm hover:bg-green-600 transition-colors">
                                            Mark as Completed
                                        </button>
                                    </form>

                                    @if($sessionSales->first()->status !== 'failed')
                                        <form action="{{ route('sales.updateStatus', $sessionId) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="failed">
                                            <button type="submit" class="status-button bg-red-500 text-white px-4 py-2 rounded text-sm hover:bg-red-600 transition-colors">
                                                Mark as Failed
                                            </button>
                                        </form>
                                    @endif
                                @endif
                            </div>
                        </div>
                        
                        <div class="px-6 py-4">
                            <div class="space-y-3">
                                @foreach($sessionSales as $sale)
                                    <div class="flex items-center justify-between py-2 border-b border-gray-100 last:border-b-0">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-gray-200 rounded flex items-center justify-center">
                                                @if($sale->product->image_path)
                                                    <img src="{{ asset('storage/' . $sale->product->image_path) }}" 
                                                         alt="{{ $sale->product->name }}" 
                                                         class="w-full h-full object-cover rounded">
                                                @else
                                                    <span class="text-xs text-gray-500">IMG</span>
                                                @endif
                                            </div>
                                            <div>
                                                <h4 class="font-medium text-gray-900 product-name">{{ $sale->product->name }}</h4>
                                                <p class="text-sm text-gray-500">{{ $sale->product->category }}</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-sm text-gray-600">
                                                {{ $sale->quantity }} × Frw {{ number_format($sale->unit_price, 2) }}
                                            </p>
                                            <p class="font-semibold text-gray-900">
                                                Frw {{ number_format($sale->total_price, 2) }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <!-- No Results Message -->
        <div id="noResultsMessage" class="hidden text-center py-8 bg-white shadow-lg rounded-lg mt-6">
            <div class="text-gray-500">
                <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No sales found</h3>
                <p class="text-gray-500">Try adjusting your search terms</p>
            </div>
        </div>

        <!-- Pagination -->
        @if($sales->hasPages())
            <div class="mt-6">
                {{ $sales->links() }}
            </div>
        @endif
    </div>

    <!-- Confirmation Modal for Status Changes -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Status change confirmation
            const statusForms = document.querySelectorAll('form[action*="updateStatus"]');
            
            statusForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    const status = this.querySelector('input[name="status"]').value;
                    const confirmation = confirm(`Are you sure you want to mark this sale as ${status}?`);
                    
                    if (!confirmation) {
                        e.preventDefault();
                    }
                });
            });

            // Search functionality for sales history
            document.getElementById('salesHistorySearchInput').addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase();
                const salesSessions = document.querySelectorAll('.sale-session');
                const noResultsMessage = document.getElementById('noResultsMessage');
                let visibleSessions = 0;
                
                salesSessions.forEach(session => {
                    const customerName = session.dataset.customerName || '';
                    const customerPhone = session.dataset.customerPhone || '';
                    const notes = session.dataset.notes || '';
                    const products = session.dataset.products || '';
                    
                    // Search in customer name, phone, notes, or product names
                    if (customerName.includes(searchTerm) || 
                        customerPhone.includes(searchTerm) || 
                        notes.includes(searchTerm) ||
                        products.includes(searchTerm)) {
                        session.style.display = '';
                        visibleSessions++;
                    } else {
                        session.style.display = 'none';
                    }
                });

                // Show/hide no results message
                if (visibleSessions === 0 && searchTerm.length > 0) {
                    noResultsMessage.classList.remove('hidden');
                    document.getElementById('salesHistoryContainer').style.display = 'none';
                } else {
                    noResultsMessage.classList.add('hidden');
                    document.getElementById('salesHistoryContainer').style.display = 'block';
                }
            });
        });
    </script>
</body>
</html>