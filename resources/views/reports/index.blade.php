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
<div class="min-h-screen bg-white py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Page Heading -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-red-600 mb-2">Reports </h1>
            <p class="text-gray-600"> Download the report </p>
        </div>

        <!-- Report Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Sales of the Week -->
            <a href="#" class="bg-red-50 border border-red-200 hover:bg-red-100 transition rounded-xl p-6 flex items-center shadow">
                <div class="flex-grow">
                    <h3 class="text-xl font-semibold text-red-700">Sales of the Week</h3>
                    <p class="text-sm text-gray-500">Export weekly sales report</p>
                </div>
                <svg class="w-6 h-6 text-red-600 ml-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 4v16m8-8H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </a>

            <!-- Sales of the Month -->
            <a href="#" class="bg-red-50 border border-red-200 hover:bg-red-100 transition rounded-xl p-6 flex items-center shadow">
                <div class="flex-grow">
                    <h3 class="text-xl font-semibold text-red-700">Sales of the Month</h3>
                    <p class="text-sm text-gray-500">Export monthly sales report</p>
                </div>
                <svg class="w-6 h-6 text-red-600 ml-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 4v16m8-8H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </a>

            <!-- Orders -->
            <a href="#" class="bg-red-50 border border-red-200 hover:bg-red-100 transition rounded-xl p-6 flex items-center shadow">
                <div class="flex-grow">
                    <h3 class="text-xl font-semibold text-red-700">Orders</h3>
                    <p class="text-sm text-gray-500">Export all order reports</p>
                </div>
                <svg class="w-6 h-6 text-red-600 ml-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 4v16m8-8H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </a>

            <!-- Imported -->
            <a href="#" class="bg-red-50 border border-red-200 hover:bg-red-100 transition rounded-xl p-6 flex items-center shadow">
                <div class="flex-grow">
                    <h3 class="text-xl font-semibold text-red-700">Imported</h3>
                    <p class="text-sm text-gray-500">Export imported items report</p>
                </div>
                <svg class="w-6 h-6 text-red-600 ml-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 4v16m8-8H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </a>

            <!-- Exported -->
            <a href="#" class="bg-red-50 border border-red-200 hover:bg-red-100 transition rounded-xl p-6 flex items-center shadow">
                <div class="flex-grow">
                    <h3 class="text-xl font-semibold text-red-700">Exported</h3>
                    <p class="text-sm text-gray-500">Export exported items report</p>
                </div>
                <svg class="w-6 h-6 text-red-600 ml-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 4v16m8-8H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </a>

            <!-- Debts -->
            <a href="#" class="bg-red-50 border border-red-200 hover:bg-red-100 transition rounded-xl p-6 flex items-center shadow">
                <div class="flex-grow">
                    <h3 class="text-xl font-semibold text-red-700">Debts</h3>
                    <p class="text-sm text-gray-500">Export unpaid debts report</p>
                </div>
                <svg class="w-6 h-6 text-red-600 ml-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 4v16m8-8H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </a>

            <!-- Pending -->
            <a href="#" class="bg-red-50 border border-red-200 hover:bg-red-100 transition rounded-xl p-6 flex items-center shadow">
                <div class="flex-grow">
                    <h3 class="text-xl font-semibold text-red-700">Pending</h3>
                    <p class="text-sm text-gray-500">Export pending reports</p>
                </div>
                <svg class="w-6 h-6 text-red-600 ml-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 4v16m8-8H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </a>
        </div>
    </div>
</div>

