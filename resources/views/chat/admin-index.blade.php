@extends('customer.navbar')

@section('title', 'Admin Chat Dashboard')

@section('content')
<div class="min-h-screen bg-gray-100 py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Chat Dashboard</h1>
                    <p class="text-gray-600">Manage customer support conversations</p>
                </div>
                <div class="flex items-center space-x-4">
                    <!-- Chat Statistics -->
                    <div class="bg-white rounded-lg px-4 py-2 shadow-sm">
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                            <span class="text-sm text-gray-600">Online</span>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg px-4 py-2 shadow-sm">
                        <div class="text-center">
                            <div class="text-lg font-semibold text-gray-900" id="active-chats-count">0</div>
                            <div class="text-xs text-gray-500">Active Chats</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="mb-6 grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-white rounded-lg p-4 shadow-sm">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="text-lg font-semibold text-gray-900" id="total-messages">0</div>
                        <div class="text-sm text-gray-600">Total Messages</div>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg p-4 shadow-sm">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="text-lg font-semibold text-gray-900" id="pending-chats">0</div>
                        <div class="text-sm text-gray-600">Pending Response</div>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg p-4 shadow-sm">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="text-lg font-semibold text-gray-900" id="active-users">0</div>
                        <div class="text-sm text-gray-600">Active Users</div>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg p-4 shadow-sm">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="text-lg font-semibold text-gray-900">95%</div>
                        <div class="text-sm text-gray-600">Response Rate</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chat Component -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            @livewire('admin-chat')
        </div>

        <!-- Quick Response Templates -->
        <div class="mt-6 bg-white rounded-lg shadow-sm p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Response Templates</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="border border-gray-200 rounded-lg p-4 hover:border-blue-300 cursor-pointer transition-colors">
                    <h4 class="font-medium text-gray-900 mb-2">Welcome Message</h4>
                    <p class="text-sm text-gray-600">Hello! Welcome to our support. How can I help you today?</p>
                </div>
                <div class="border border-gray-200 rounded-lg p-4 hover:border-blue-300 cursor-pointer transition-colors">
                    <h4 class="font-medium text-gray-900 mb-2">Order Status</h4>
                    <p class="text-sm text-gray-600">Let me check your order status for you. Please provide your order number.</p>
                </div>
                <div class="border border-gray-200 rounded-lg p-4 hover:border-blue-300 cursor-pointer transition-colors">
                    <h4 class="font-medium text-gray-900 mb-2">Technical Issue</h4>
                    <p class="text-sm text-gray-600">I understand you're experiencing a technical issue. Let me help you resolve this.</p>
                </div>
                <div class="border border-gray-200 rounded-lg p-4 hover:border-blue-300 cursor-pointer transition-colors">
                    <h4 class="font-medium text-gray-900 mb-2">Refund Request</h4>
                    <p class="text-sm text-gray-600">I'll be happy to help with your refund request. Let me review your order details.</p>
                </div>
                <div class="border border-gray-200 rounded-lg p-4 hover:border-blue-300 cursor-pointer transition-colors">
                    <h4 class="font-medium text-gray-900 mb-2">Thank You</h4>
                    <p class="text-sm text-gray-600">Thank you for contacting us. Is there anything else I can help you with?</p>
                </div>
                <div class="border border-gray-200 rounded-lg p-4 hover:border-blue-300 cursor-pointer transition-colors">
                    <h4 class="font-medium text-gray-900 mb-2">Follow Up</h4>
                    <p class="text-sm text-gray-600">I wanted to follow up on our previous conversation. How is everything going?</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Simple statistics update (you can make this dynamic with Livewire)
    document.addEventListener('DOMContentLoaded', function() {
        // This is just for demo - you can make these dynamic with Livewire
        document.getElementById('total-messages').textContent = '{{ \App\Models\Message::count() }}';
        document.getElementById('active-chats').textContent = '{{ \App\Models\Chat::whereDate("last_message_at", today())->count() }}';
        document.getElementById('active-users').textContent = '{{ \App\Models\User::where("role", "user")->count() }}';
        document.getElementById('pending-chats').textContent = '0'; // You can calculate this based on unread messages
    });
</script>
@endsection