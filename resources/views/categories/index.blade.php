<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Categories</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Navbar -->
  @include('dashboard.navbar')

    <!-- Content -->
    <div class="max-w-3xl mx-auto p-6 space-y-6">
        <h2 class="text-xl font-semibold text-gray-800">Add Inventory Categories</h2>

        <!-- Main Category Form -->
        <form method="POST" action="{{ route('categories.storeMain') }}" class="bg-white p-4 rounded shadow border-l-4 border-red-500">
            @csrf
            <h3 class="font-semibold text-gray-700 mb-2">1. Main Category</h3>
            <input type="text" name="main_category" placeholder="Enter Main Category" class="w-full px-4 py-2 border border-red-500 rounded mb-2" required>
            <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Save Main Category</button>
        </form>

        <!-- Brand Form -->
        <form method="POST" action="{{ route('categories.storeBrand') }}" class="bg-white p-4 rounded shadow border-l-4 border-red-500">
            @csrf
            <h3 class="font-semibold text-gray-700 mb-2">2. Brand </h3>
            <select name="main_category_id" class="w-full px-4 py-2 border border-gray-300 rounded mb-2" required>
                <option value="">Select Main Category</option>
                @foreach($mainCategories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
            <input type="text" name="brand" placeholder="Enter Brand Name" class="w-full px-4 py-2 border border-red-500 rounded mb-2" required>
            <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Save Brand</button>
        </form>

        <!-- Type Form -->
        <form method="POST" action="{{ route('categories.storeType') }}" class="bg-white p-4 rounded shadow border-l-4 border-red-500">
            @csrf
            <h3 class="font-semibold text-gray-700 mb-2">3. Type</h3>
            <select name="brand_id" class="w-full px-4 py-2 border border-gray-300 rounded mb-2" required>
                <option value="">Select Brand</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
            </select>
            <input type="text" name="type" placeholder="Enter Type (New/Used)" class="w-full px-4 py-2 border border-red-500 rounded mb-2" required>
            <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Save Type</button>
        </form>

        <!-- Size Form -->
        <form method="POST" action="{{ route('categories.storeSize') }}" class="bg-white p-4 rounded shadow border-l-4 border-red-500">
            @csrf
            <h3 class="font-semibold text-gray-700 mb-2">4.Size or Product code</h3>
            <select name="type_id" class="w-full px-4 py-2 border border-gray-300 rounded mb-2" required>
                <option value="">Select Type</option>
                @foreach($types as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
            <input type="text" name="size" placeholder="Enter Size (e.g., 16in, 225/65)" class="w-full px-4 py-2 border border-red-500 rounded mb-2" required>
            <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Save Size</button>
        </form>
    </div>
</body>
</html>
