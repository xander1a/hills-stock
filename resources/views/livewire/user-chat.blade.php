<div>
  <div class="container mx-auto p-4">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="bg-blue-600 text-white p-4">
            <h2 class="text-xl font-semibold">Chat Support</h2>
        </div>
        
        <div class="flex h-96">
            <!-- Chat List Sidebar -->
            <div class="w-1/3 border-r border-gray-200 bg-gray-50">
                <div class="p-4 border-b border-gray-200">
                    <h3 class="font-semibold text-gray-700 mb-3">Start New Chat</h3>
                    <div class="space-y-2">
                        @foreach($admins as $admin)
                            <button 
                                wire:click="startChat({{ $admin->id }})"
                                class="w-full text-left px-3 py-2 rounded bg-blue-100 hover:bg-blue-200 text-blue-800 text-sm transition-colors">
                                Chat with {{ $admin->name }}
                            </button>
                        @endforeach
                    </div>
                </div>
                
                <div class="p-4">
                    <h3 class="font-semibold text-gray-700 mb-3">Your Chats</h3>
                    <div class="space-y-2">
                        @forelse($chats as $chat)
                            <div 
                                wire:click="selectChat({{ $chat->id }})"
                                class="cursor-pointer p-3 rounded-lg hover:bg-gray-100 transition-colors {{ $selectedChatId == $chat->id ? 'bg-blue-100 border-l-4 border-blue-500' : '' }}">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="font-medium text-gray-800">{{ $chat->admin->name }}</p>
                                        @if($chat->latestMessage)
                                            <p class="text-sm text-gray-600 truncate">
                                                {{ Str::limit($chat->latestMessage->message, 30) }}
                                            </p>
                                        @endif
                                    </div>
                                    @if($chat->unread_count > 0)
                                        <span class="bg-red-500 text-white text-xs rounded-full px-2 py-1 min-w-[20px] text-center">
                                            {{ $chat->unread_count }}
                                        </span>
                                    @endif
                                </div>
                                @if($chat->last_message_at)
                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ $chat->last_message_at->diffForHumans() }}
                                    </p>
                                @endif
                            </div>
                        @empty
                            <p class="text-gray-500 text-sm">No chats yet. Start a new chat with an admin.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Chat Messages Area -->
            <div class="flex-1 flex flex-col">
                @if($selectedChatId)
                    <!-- Messages -->
                    <div class="flex-1 p-4 overflow-y-auto bg-gray-50" id="messages-container">
                        @forelse($messages as $message)
                            <div class="mb-4 {{ $message->sender_id == auth()->id() ? 'text-right' : 'text-left' }}">
                                <div class="inline-block max-w-xs lg:max-w-md px-4 py-2 rounded-lg {{ $message->sender_id == auth()->id() ? 'bg-blue-500 text-white' : 'bg-white text-gray-800 border' }}">
                                    <p class="break-words">{{ $message->message }}</p>
                                    <p class="text-xs mt-1 {{ $message->sender_id == auth()->id() ? 'text-blue-100' : 'text-gray-500' }}">
                                        {{ $message->created_at->format('M j, H:i') }}
                                    </p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-gray-500 mt-8">
                                <p>No messages yet. Start the conversation!</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Message Input -->
                    <div class="border-t border-gray-200 p-4 bg-white">
                        <form wire:submit.prevent="sendMessage" class="flex space-x-2">
                            <input 
                                type="text" 
                                wire:model="newMessage"
                                placeholder="Type your message..."
                                class="flex-1 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <button 
                                type="submit"
                                class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg transition-colors">
                                Send
                            </button>
                        </form>
                    </div>
                @else
                    <div class="flex-1 flex items-center justify-center bg-gray-50">
                        <div class="text-center text-gray-500">
                            <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                            <p class="text-lg">Select a chat to start messaging</p>
                            <p class="text-sm">Choose from your existing chats or start a new one</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:updated', function () {
        const container = document.getElementById('messages-container');
        if (container) {
            container.scrollTop = container.scrollHeight;
        }
    });
</script>
</div>
