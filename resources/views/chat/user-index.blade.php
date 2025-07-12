@extends('customer.navbar')

@section('title', 'Support Chat')

@section('content')
<div class="min-h-screen bg-gray-100 py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Support Chat</h1>
                    <p class="text-gray-600">Get help from our support team</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="bg-white rounded-lg px-4 py-2 shadow-sm">
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                            <span class="text-sm text-gray-600">Online Support</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chat Component -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            @livewire('user-chat')
        </div>

        <!-- Help Section -->
        <div class="mt-6 bg-blue-50 rounded-lg p-6">
            <h3 class="text-lg font-semibold text-blue-900 mb-2">Need Help?</h3>
            <p class="text-blue-800 mb-4">Our support team is here to help you with any questions about your orders, products, or account.</p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white rounded-lg p-4 shadow-sm">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900">General Support</h4>
                            <p class="text-sm text-gray-600">Get help with orders and products</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg p-4 shadow-sm">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900">Order Status</h4>
                            <p class="text-sm text-gray-600">Track your order progress</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg p-4 shadow-sm">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900">Account Issues</h4>
                            <p class="text-sm text-gray-600">Account and login support</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection