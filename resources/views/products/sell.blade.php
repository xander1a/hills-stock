<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sell Product - Inventory Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen">
    @include('dashboard.navbar')

    <div class="max-w-4xl mx-auto p-6">
        <div class="flex items-center mb-8">
            <svg class="w-8 h-8 text-red-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 3h2l.4 2M7 13h10l4-8H5.4m1.6 10L5 3H3m4 10a2 2 0 104 0m6 0a2 2 0 104 0"/>
            </svg>
            <h2 class="text-3xl font-bold text-gray-800">Sell Product</h2>
        </div>

        <div class="bg-white shadow-lg border-2 border-red-500 p-8">
            <form id="sellProductForm" action="{{ route('sales.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Hidden product ID -->
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <!-- Product Info -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M13 16h-1v-4H9m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Selected Product Information
                    </h3>

                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <span class="text-sm font-medium text-gray-600">Product Name:</span>
                                <p class="text-lg font-semibold text-gray-800">{{ $product->name }}</p>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-600">Unit Price:</span>
                                <p class="text-lg font-semibold text-green-600">{{ number_format($product->price, 2) }} RWF</p>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-600">Available Stock:</span>
                                <p class="text-lg font-semibold text-blue-600">{{ $product->total_quantity }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sale Details -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                        Sale Details
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="quantity" class="block text-sm font-medium text-gray-700 mb-2">Quantity *</label>
                            <input type="number" id="quantity" name="quantity" min="1" max="{{ $product->total_quantity }}" required
                                   class="w-full px-3 py-2 border border-gray-300 focus:ring-red-500 focus:border-red-500"
                                   placeholder="Enter quantity">
                            <p id="quantityError" class="text-red-500 text-sm mt-1 hidden">Insufficient stock available</p>
                        </div>

                        <div>
                            <label for="saleDate" class="block text-sm font-medium text-gray-700 mb-2">Sale Date *</label>
                            <input type="datetime-local" id="saleDate" name="sale_date" required
                                   class="w-full px-3 py-2 border border-gray-300 focus:ring-red-500 focus:border-red-500">
                        </div>
                    </div>
                </div>

                <!-- Customer Info -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Customer Information
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="customerName" class="block text-sm font-medium text-gray-700 mb-2">Customer Name</label>
                            <input type="text" name="customer_name"
                                   class="w-full px-3 py-2 border border-gray-300 focus:ring-red-500 focus:border-red-500"
                                   placeholder="Enter customer name">
                        </div>

                        <div>
                            <label for="customerEmail" class="block text-sm font-medium text-gray-700 mb-2">Customer Email</label>
                            <input type="email" name="customer_email"
                                   class="w-full px-3 py-2 border border-gray-300 focus:ring-red-500 focus:border-red-500"
                                   placeholder="Enter customer email">
                        </div>
                    </div>

                    <div class="mt-6">
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Sale Notes</label>
                        <textarea name="notes" rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 focus:ring-red-500 focus:border-red-500"
                                  placeholder="Optional notes..."></textarea>
                    </div>
                </div>

                <!-- Payment Info -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                        </svg>
                        Payment Information
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Payment Method *</label>
                            <select name="payment_method" required
                                    class="w-full px-3 py-2 border border-gray-300 focus:ring-red-500 focus:border-red-500">
                                <option value="">Select</option>
                                <option value="cash">Cash</option>
                                <option value="credit_card">Credit Card</option>
                                <option value="debit_card">Debit Card</option>
                                <option value="digital_wallet">Digital Wallet</option>
                                <option value="bank_transfer">Bank Transfer</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Total Amount (RWF)</label>
                            <input type="number" id="totalAmount" name="total_amount" step="0.01" min="0" readonly
                                   class="w-full px-3 py-2 border bg-gray-100 border-gray-300 focus:ring-red-500 focus:border-red-500"
                                   placeholder="0.00">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Discount (%)</label>
                            <input type="number" id="discount" name="discount" step="0.01" min="0" max="100"
                                   class="w-full px-3 py-2 border border-gray-300 focus:ring-red-500 focus:border-red-500"
                                   placeholder="0.00">
                        </div>
                    </div>

                    <div class="mt-6 bg-green-50 p-4 rounded-lg flex justify-between items-center">
                        <span class="text-lg font-medium text-gray-700">Final Amount:</span>
                        <span id="finalAmount" class="text-2xl font-bold text-green-600">RWF 0.00</span>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                    <button type="submit"
                            class="flex-1 bg-red-500 text-white py-3 px-6 hover:bg-red-600 focus:ring-2 focus:ring-red-500 focus:ring-offset-2 rounded font-medium">
                        Record Sale
                    </button>

                    <a href="{{ route('products.index') }}"
                       class="flex-1 text-center bg-gray-500 text-white py-3 px-6 hover:bg-gray-600 focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 rounded font-medium">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('saleDate').value = new Date().toISOString().slice(0, 16);

            document.getElementById('quantity').addEventListener('input', updateTotals);
            document.getElementById('discount').addEventListener('input', updateTotals);

            function updateTotals() {
                const price = {{ $product->price }};
                const quantity = parseInt(document.getElementById('quantity').value) || 0;
                const discount = parseFloat(document.getElementById('discount').value) || 0;

                const subtotal = price * quantity;
                const discountAmount = (subtotal * discount) / 100;
                const finalAmount = subtotal - discountAmount;

                document.getElementById('totalAmount').value = subtotal.toFixed(2);
                document.getElementById('finalAmount').textContent = 'RWF ' + finalAmount.toFixed(2);
            }
        });
    </script>
</body>
</html>
