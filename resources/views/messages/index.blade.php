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


<div class="min-h-screen bg-white py-10 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Page Heading -->
        <div class="mb-6 border-b border-red-500 pb-4">
            <h1 class="text-3xl font-bold text-red-600">Messages</h1>
            <p class="text-gray-600">This is a template inbox page with fake data for design purposes.</p>
        </div>

        <!-- Static Message Cards -->
        <div class="bg-white shadow rounded-lg border border-red-200 divide-y divide-red-100">
            @for($i = 1; $i <= 5; $i++)
            <div class="p-4 hover:bg-red-50 transition">
                <div class="flex justify-between items-center mb-1">
                    <h2 class="text-lg font-semibold text-red-700">Subject {{ $i }}: Sample Message Title</h2>
                    <span class="text-sm text-gray-500">2025-06-30 14:{{ 40 + $i }}</span>
                </div>
                <p class="text-sm text-gray-700">
                    This is a preview of a sample message body for item {{ $i }}. You can place any placeholder content here...
                </p>
                <div class="mt-2">
                    <a href="#" class="text-sm text-red-600 hover:underline">Read more</a>
                </div>
            </div>
            @endfor
        </div>

        <!-- Fake Pagination -->
        <div class="mt-6 flex justify-center space-x-2 text-sm">
            <span class="text-red-600 font-semibold">1</span>
            <a href="#" class="text-gray-500 hover:text-red-600">2</a>
            <a href="#" class="text-gray-500 hover:text-red-600">3</a>
            <span class="text-gray-300">...</span>
            <a href="#" class="text-gray-500 hover:text-red-600">10</a>
        </div>
    </div>
</div>

