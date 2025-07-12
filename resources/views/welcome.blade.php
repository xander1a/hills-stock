<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
<div class="bg-white p-8 shadow-md w-96 border-red-500 border-2">
    <h2 class="text-xl font-bold text-center mb-6 text-red-500">Login</h2>
    @if ($errors->any())
        <div class="mb-4 text-red-500 text-sm">
            {{ $errors->first() }}
        </div>
    @endif
    <form method="POST" action="{{ route('login.submit') }}">
        @csrf
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" name="email" class="w-full px-3 py-2 border border-red-500 rounded focus:outline-none" required>
        </div>
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <input type="password" name="password" class="w-full px-3 py-2 border border-red-500 rounded focus:outline-none" required>
        </div>
        <button type="submit" class="w-full bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">Sign In</button>
    </form>
</div>
</body>
</html>
