<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sell Product - Sales Dashboard</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Navigation Bar -->
    @include('dashboard.navbar')

    <!-- Main Content -->
    <div class="max-w-6xl mx-auto p-6">
        <div class="flex items-center mb-8">
            <svg class="w-8 h-8 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M8 11v6h8v-6M8 11H6a2 2 0 00-2 2v6a2 2 0 002 2h12a2 2 0 002-2v-6a2 2 0 00-2-2h-2"></path>
            </svg>
            <h2 class="text-3xl font-bold text-gray-800">New Sale</h2>
        </div>
        
        <!-- Form Container -->
        <div class="bg-white shadow-lg border-2 border-green-500 p-8">
            <form id="salesForm" action="{{ route('sales.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Customer Information -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Customer Information
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="customerName" class="block text-sm font-medium text-gray-700 mb-2">Customer Name *</label>
                            <input type="text" id="customerName" required name="customer_name"
                                   class="w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors"
                                   placeholder="Enter customer name">
                        </div>
                        
                        <div>
                            <label for="customerPhone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                            <input type="tel" id="customerPhone" name="customer_phone"
                                   class="w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors"
                                   placeholder="Enter phone number">
                        </div>
                        
                        <div>
                            <label for="customerEmail" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                            <input type="email" id="customerEmail" name="customer_email"
                                   class="w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors"
                                   placeholder="Enter email address">
                        </div>
                        
                        <div>
                            <label for="customerAddress" class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                            <input type="text" id="customerAddress" name="customer_address"
                                   class="w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors"
                                   placeholder="Enter address">
                        </div>
                    </div>
                </div>

                <!-- Product Selection -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"></path>
                        </svg>
                        Product Selection
                    </h3>
                    
                    <div id="productItems">
                        <div class="product-item border border-gray-200 rounded-lg p-4 mb-4">
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Product *</label>
                                    <select name="products[0][product_id]" required
                                            class="product-select w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors">
                                        <option value="">Select Product</option>
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}" data-price="{{ $product->price }}" data-stock="{{ $product->total_quantity }}">
                                                {{ $product->name }} - ${{ $product->price }} (Stock: {{ $product->total_quantity }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Quantity *</label>
                                    <input type="number" name="products[0][quantity]" min="1" required
                                           class="quantity-input w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors"
                                           placeholder="1">
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Unit Price ($)</label>
                                    <input type="number" name="products[0][unit_price]" step="0.01" readonly
                                           class="unit-price w-full px-3 py-2 border border-gray-300 bg-gray-100 focus:outline-none transition-colors"
                                           placeholder="0.00">
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Total ($)</label>
                                    <input type="number" name="products[0][total_price]" step="0.01" readonly
                                           class="item-total w-full px-3 py-2 border border-gray-300 bg-gray-100 focus:outline-none transition-colors"
                                           placeholder="0.00">
                                </div>
                            </div>
                            
                            <div class="mt-4 flex justify-end">
                                <button type="button" onclick="removeProduct(this)" 
                                        class="remove-product bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition-colors text-sm">
                                    Remove Product
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <button type="button" onclick="addProduct()" 
                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition-colors flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <span>Add Another Product</span>
                    </button>
                </div>

                <!-- Sale Details -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                        Sale Details
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="saleDate" class="block text-sm font-medium text-gray-700 mb-2">Sale Date *</label>
                            <input type="date" id="saleDate" name="sale_date" required
                                   class="w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors"
                                   value="{{ date('Y-m-d') }}">
                        </div>
                        
                        <div>
                            <label for="paymentMethod" class="block text-sm font-medium text-gray-700 mb-2">Payment Method *</label>
                            <select id="paymentMethod" name="payment_method" required
                                    class="w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors">
                                <option value="">Select Payment Method</option>
                                <option value="cash">Cash</option>
                                <option value="card">Credit/Debit Card</option>
                                <option value="bank_transfer">Bank Transfer</option>
                                <option value="mobile_money">Mobile Money</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="discount" class="block text-sm font-medium text-gray-700 mb-2">Discount ($)</label>
                            <input type="number" id="discount" name="discount" step="0.01" min="0"
                                   class="w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors"
                                   placeholder="0.00" value="0">
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
                        <textarea id="notes" rows="3" name="notes"
                                  class="w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors"
                                  placeholder="Enter any additional notes"></textarea>
                    </div>
                </div>

                <!-- Total Summary -->
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Order Summary</h3>
                    
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Subtotal:</span>
                            <span id="subtotal" class="font-semibold">$0.00</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Discount:</span>
                            <span id="discountAmount" class="font-semibold">-$0.00</span>
                        </div>
                        <div class="border-t pt-2 flex justify-between text-lg font-bold">
                            <span>Total:</span>
                            <span id="grandTotal" class="text-green-600">$0.00</span>
                        </div>
                    </div>
                    
                    <input type="hidden" name="subtotal" id="subtotalInput">
                    <input type="hidden" name="total_amount" id="totalAmountInput">
                </div>

                <!-- Form Actions -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                    <button type="submit" 
                            class="flex-1 bg-green-500 text-white py-3 px-6 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors font-medium flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>Complete Sale</span>
                    </button>
                    
                    <button type="button" 
                            class="flex-1 bg-gray-500 text-white py-3 px-6 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors font-medium flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        <span>Cancel</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let productIndex = 1;

        function addProduct() {
            const productItems = document.getElementById('productItems');
            const newProduct = document.querySelector('.product-item').cloneNode(true);
            
            // Update field names and IDs
            const inputs = newProduct.querySelectorAll('input, select');
            inputs.forEach(input => {
                if (input.name) {
                    input.name = input.name.replace(/\[0\]/, `[${productIndex}]`);
                }
                if (input.type !== 'button') {
                    input.value = '';
                }
            });
            
            productItems.appendChild(newProduct);
            productIndex++;
            
            // Add event listeners to new product
            addProductEventListeners(newProduct);
        }

        function removeProduct(button) {
            const productItems = document.querySelectorAll('.product-item');
            if (productItems.length > 1) {
                button.closest('.product-item').remove();
                calculateTotal();
            }
        }

        function addProductEventListeners(productItem) {
            const productSelect = productItem.querySelector('.product-select');
            const quantityInput = productItem.querySelector('.quantity-input');
            const unitPriceInput = productItem.querySelector('.unit-price');
            const totalInput = productItem.querySelector('.item-total');

            productSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const price = selectedOption.getAttribute('data-price') || 0;
                unitPriceInput.value = price;
                calculateItemTotal(productItem);
            });

            quantityInput.addEventListener('input', function() {
                calculateItemTotal(productItem);
            });
        }

        function calculateItemTotal(productItem) {
            const quantity = parseFloat(productItem.querySelector('.quantity-input').value) || 0;
            const unitPrice = parseFloat(productItem.querySelector('.unit-price').value) || 0;
            const total = quantity * unitPrice;
            
            productItem.querySelector('.item-total').value = total.toFixed(2);
            calculateTotal();
        }

        function calculateTotal() {
            let subtotal = 0;
            
            document.querySelectorAll('.item-total').forEach(input => {
                subtotal += parseFloat(input.value) || 0;
            });
            
            const discount = parseFloat(document.getElementById('discount').value) || 0;
            const total = subtotal - discount;
            
            document.getElementById('subtotal').textContent = '$' + subtotal.toFixed(2);
            document.getElementById('discountAmount').textContent = '-$' + discount.toFixed(2);
            document.getElementById('grandTotal').textContent = '$' + total.toFixed(2);
            
            document.getElementById('subtotalInput').value = subtotal.toFixed(2);
            document.getElementById('totalAmountInput').value = total.toFixed(2);
        }

        // Initialize event listeners
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.product-item').forEach(addProductEventListeners);
            
            document.getElementById('discount').addEventListener('input', calculateTotal);
        });
    </script>
</body>
</html>