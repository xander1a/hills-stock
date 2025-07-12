<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4f46e5',
                        secondary: '#6b7280',
                        danger: '#ef4444',
                        success: '#10b981',
                        warning: '#f59e0b',
                    }
                }
            }
        }
    </script>
    <style>
        .sidebar {
            transition: all 0.3s ease;
        }
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.active {
                transform: translateX(0);
            }
        }
        .dropdown:hover .dropdown-menu {
            display: block;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div class="sidebar bg-white w-64 fixed h-full shadow-lg z-10">
            <div class="p-4 border-b border-gray-200">
                <h1 class="text-xl font-bold text-primary">Stock Manager</h1>
            </div>
            <nav class="mt-4">
                <a href="#" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-100">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    <span>Dashboard</span>
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-primary bg-primary bg-opacity-10">
                    <i class="fas fa-warehouse mr-3"></i>
                    <span>Inventory</span>
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-100">
                    <i class="fas fa-truck mr-3"></i>
                    <span>Suppliers</span>
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-100">
                    <i class="fas fa-file-invoice-dollar mr-3"></i>
                    <span>Orders</span>
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-100">
                    <i class="fas fa-chart-line mr-3"></i>
                    <span>Reports</span>
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-100">
                    <i class="fas fa-cog mr-3"></i>
                    <span>Settings</span>
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto ml-0 md:ml-64">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm">
                <div class="flex justify-between items-center p-4">
                    <button class="md:hidden text-gray-600" id="sidebarToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <input type="text" placeholder="Search inventory..." class="pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                        <div class="relative">
                            <button class="text-gray-600">
                                <i class="fas fa-bell"></i>
                                <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-danger"></span>
                            </button>
                        </div>
                        <div class="flex items-center dropdown relative">
                            <img src="https://randomuser.me/api/portraits/men/1.jpg" alt="User" class="w-8 h-8 rounded-full cursor-pointer">
                            <span class="ml-2 font-medium cursor-pointer">Admin</span>
                            <div class="dropdown-menu absolute hidden right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-20">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Log out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Inventory Management</h2>
                    <div class="flex space-x-3">
                        <button class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-50 transition flex items-center">
                            <i class="fas fa-filter mr-2"></i> Filter
                        </button>
                        <button class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-opacity-90 transition flex items-center" id="addProductBtn">
                            <i class="fas fa-plus mr-2"></i> Add Product
                        </button>
                    </div>
                </div>

                <!-- Inventory Summary Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                    <div class="bg-white p-4 rounded-lg shadow">
                        <div class="flex justify-between">
                            <div>
                                <p class="text-gray-500">Total Products</p>
                                <h3 class="text-2xl font-bold">1,248</h3>
                            </div>
                            <div class="bg-primary bg-opacity-10 p-3 rounded-full">
                                <i class="fas fa-box text-primary"></i>
                            </div>
                        </div>
                        <p class="text-sm text-success mt-2"><i class="fas fa-arrow-up mr-1"></i> 12% from last month</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow">
                        <div class="flex justify-between">
                            <div>
                                <p class="text-gray-500">Total Value</p>
                                <h3 class="text-2xl font-bold">$48,752</h3>
                            </div>
                            <div class="bg-success bg-opacity-10 p-3 rounded-full">
                                <i class="fas fa-dollar-sign text-success"></i>
                            </div>
                        </div>
                        <p class="text-sm text-success mt-2"><i class="fas fa-arrow-up mr-1"></i> 8% from last month</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow">
                        <div class="flex justify-between">
                            <div>
                                <p class="text-gray-500">Low Stock</p>
                                <h3 class="text-2xl font-bold">42</h3>
                            </div>
                            <div class="bg-warning bg-opacity-10 p-3 rounded-full">
                                <i class="fas fa-exclamation-triangle text-warning"></i>
                            </div>
                        </div>
                        <p class="text-sm text-danger mt-2"><i class="fas fa-arrow-up mr-1"></i> 5 more than last month</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow">
                        <div class="flex justify-between">
                            <div>
                                <p class="text-gray-500">Out of Stock</p>
                                <h3 class="text-2xl font-bold">18</h3>
                            </div>
                            <div class="bg-danger bg-opacity-10 p-3 rounded-full">
                                <i class="fas fa-times-circle text-danger"></i>
                            </div>
                        </div>
                        <p class="text-sm text-success mt-2"><i class="fas fa-arrow-down mr-1"></i> 3 less than last month</p>
                    </div>
                </div>

                <!-- Inventory Table -->
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="flex justify-between items-center p-4 border-b">
                        <div class="flex space-x-2">
                            <select class="border rounded-lg px-3 py-1 text-sm">
                                <option>All Categories</option>
                                <option>Electronics</option>
                                <option>Clothing</option>
                                <option>Food & Beverage</option>
                                <option>Home & Garden</option>
                            </select>
                            <select class="border rounded-lg px-3 py-1 text-sm">
                                <option>All Status</option>
                                <option>In Stock</option>
                                <option>Low Stock</option>
                                <option>Out of Stock</option>
                            </select>
                            <select class="border rounded-lg px-3 py-1 text-sm">
                                <option>Sort by: Newest</option>
                                <option>Sort by: Oldest</option>
                                <option>Sort by: Name (A-Z)</option>
                                <option>Sort by: Name (Z-A)</option>
                                <option>Sort by: Stock (High-Low)</option>
                                <option>Sort by: Stock (Low-High)</option>
                            </select>
                        </div>
                        <div class="flex space-x-2">
                            <button class="text-gray-500 hover:text-gray-700 px-3 py-1 rounded border">
                                <i class="fas fa-download mr-1"></i> Export
                            </button>
                            <button class="text-gray-500 hover:text-gray-700 px-3 py-1 rounded border">
                                <i class="fas fa-print mr-1"></i> Print
                            </button>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SKU</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Value</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <!-- Product 1 -->
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded" src="https://via.placeholder.com/40" alt="">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">MacBook Pro 16"</div>
                                                <div class="text-sm text-gray-500">Apple</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">MBP-16-001</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Electronics</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">25</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$2,499.00</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$62,475.00</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-success bg-opacity-10 text-success">In Stock</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <button class="text-primary hover:text-primary-dark" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-danger hover:text-danger-dark" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <button class="text-secondary hover:text-secondary-dark" title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                
                                <!-- Product 2 -->
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded" src="https://via.placeholder.com/40" alt="">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">AirPods Pro</div>
                                                <div class="text-sm text-gray-500">Apple</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">AP-PRO-002</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Electronics</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">4</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$249.00</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$996.00</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-warning bg-opacity-10 text-warning">Low Stock</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <button class="text-primary hover:text-primary-dark" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-danger hover:text-danger-dark" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <button class="text-secondary hover:text-secondary-dark" title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                
                                <!-- Product 3 -->
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded" src="https://via.placeholder.com/40" alt="">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">Nike Air Max</div>
                                                <div class="text-sm text-gray-500">Men's Shoes</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">NK-AM-003</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Clothing</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">0</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$150.00</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$0.00</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-danger bg-opacity-10 text-danger">Out of Stock</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <button class="text-primary hover:text-primary-dark" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-danger hover:text-danger-dark" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <button class="text-secondary hover:text-secondary-dark" title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                
                                <!-- Product 4 -->
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded" src="https://via.placeholder.com/40" alt="">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">Organic Coffee</div>
                                                <div class="text-sm text-gray-500">1lb Bag</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">ORG-CF-004</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Food & Beverage</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">48</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$12.99</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$623.52</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-success bg-opacity-10 text-success">In Stock</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <button class="text-primary hover:text-primary-dark" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-danger hover:text-danger-dark" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <button class="text-secondary hover:text-secondary-dark" title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                
                                <!-- Product 5 -->
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded" src="https://via.placeholder.com/40" alt="">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">Ceramic Planter</div>
                                                <div class="text-sm text-gray-500">Large</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">CER-PT-005</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Home & Garden</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">12</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$34.99</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$419.88</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-success bg-opacity-10 text-success">In Stock</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <button class="text-primary hover:text-primary-dark" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-danger hover:text-danger-dark" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <button class="text-secondary hover:text-secondary-dark" title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                        <div class="flex-1 flex justify-between sm:hidden">
                            <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">Previous</a>
                            <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">Next</a>
                        </div>
                        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm text-gray-700">
                                    Showing <span class="font-medium">1</span> to <span class="font-medium">5</span> of <span class="font-medium">24</span> results
                                </p>
                            </div>
                            <div>
                                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                    <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                        <span class="sr-only">Previous</span>
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                    <a href="#" aria-current="page" class="z-10 bg-primary border-primary text-white relative inline-flex items-center px-4 py-2 border text-sm font-medium">1</a>
                                    <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">2</a>
                                    <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">3</a>
                                    <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">4</a>
                                    <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">5</a>
                                    <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                        <span class="sr-only">Next</span>
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Add Product Modal -->
    <div class="fixed z-50 inset-0 overflow-y-auto hidden" id="addProductModal">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Add New Product</h3>
                                <button type="button" class="text-gray-400 hover:text-gray-500" id="closeModalBtn">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <form>
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="productName">Product Name*</label>
                                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" id="productName" type="text" placeholder="Enter product name" required>
                                </div>
                                <div class="grid grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="sku">SKU*</label>
                                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" id="sku" type="text" placeholder="Enter SKU" required>
                                    </div>
                                    <div>
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="barcode">Barcode</label>
                                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" id="barcode" type="text" placeholder="Enter barcode">
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="category">Category*</label>
                                        <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" id="category" required>
                                            <option value="">Select category</option>
                                            <option>Electronics</option>
                                            <option>Clothing</option>
                                            <option>Food & Beverage</option>
                                            <option>Home & Garden</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="supplier">Supplier</label>
                                        <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" id="supplier">
                                            <option value="">Select supplier</option>
                                            <option>Apple Inc.</option>
                                            <option>Nike</option>
                                            <option>Starbucks</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="grid grid-cols-3 gap-4 mb-4">
                                    <div>
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="stock">Stock*</label>
                                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" id="stock" type="number" placeholder="0" required>
                                    </div>
                                    <div>
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="price">Price*</label>
                                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" id="price" type="number" step="0.01" placeholder="0.00" required>
                                    </div>
                                    <div>
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="cost">Cost</label>
                                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" id="cost" type="number" step="0.01" placeholder="0.00">
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="description">Description</label>
                                    <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" id="description" rows="3" placeholder="Enter product description"></textarea>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Product Image</label>
                                    <div class="mt-1 flex items-center">
                                        <span class="inline-block h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                                            <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                            </svg>
                                        </span>
                                        <button type="button" class="ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                                            Change
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary text-base font-medium text-white hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary sm:ml-3 sm:w-auto sm:text-sm">
                        Save Product
                    </button>
                    <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" id="cancelAddProduct">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle sidebar on mobile
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
        });

        // Show add product modal
        document.getElementById('addProductBtn').addEventListener('click', function() {
            document.getElementById('addProductModal').classList.remove('hidden');
        });

        // Hide add product modal
        document.getElementById('cancelAddProduct').addEventListener('click', function() {
            document.getElementById('addProductModal').classList.add('hidden');
        });

        // Close modal when clicking X button
        document.getElementById('closeModalBtn').addEventListener('click', function() {
            document.getElementById('addProductModal').classList.add('hidden');
        });

        // Close modal when clicking outside
        document.getElementById('addProductModal').addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.add('hidden');
            }
        });
    </script>
</body>
</html>