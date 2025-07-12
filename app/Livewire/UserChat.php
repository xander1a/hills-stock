<?php

namespace App\Livewire;

use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class UserChat extends Component
{
    public $selectedChatId = null;
    public $newMessage = '';
    public $chats = [];
    public $messages = [];
    public $admins = [];

    protected $listeners = ['refreshChat' => 'loadChats'];

    public function mount()
    {
        $this->loadChats();
        $this->loadAdmins();
    }

    public function loadChats()
    {
        $this->chats = Chat::where('user_id', Auth::id())
            ->with(['admin', 'latestMessage'])
            ->orderBy('last_message_at', 'desc')
            ->get()
            ->map(function ($chat) {
                $chat->unread_count = $chat->unreadMessagesForUser(Auth::id());
                return $chat;
            });
    }

    public function loadAdmins()
    {
        $this->admins = User::where('role', 'admin')->get();
    }

    public function startChat($adminId)
    {
        $chat = Chat::firstOrCreate([
            'user_id' => Auth::id(),
            'admin_id' => $adminId
        ], [
            'title' => 'Chat with ' . User::find($adminId)->name
        ]);

        $this->selectedChatId = $chat->id;
        $this->loadMessages();
        $this->loadChats();
    }

    public function selectChat($chatId)
    {
        $this->selectedChatId = $chatId;
        $this->markMessagesAsRead($chatId);
        $this->loadMessages();
        $this->loadChats();
    }

    public function loadMessages()
    {
        if ($this->selectedChatId) {
            $this->messages = Message::where('chat_id', $this->selectedChatId)
                ->with('sender')
                ->orderBy('created_at', 'asc')
                ->get();
        }
    }

    public function sendMessage()
    {
        if (empty(trim($this->newMessage)) || !$this->selectedChatId) {
            return;
        }

        Message::create([
            'chat_id' => $this->selectedChatId,
            'sender_id' => Auth::id(),
            'message' => $this->newMessage,
        ]);

        Chat::where('id', $this->selectedChatId)->update([
            'last_message_at' => now()
        ]);

        $this->newMessage = '';
        $this->loadMessages();
        $this->loadChats();
        $this->dispatch('refreshChat');
    }

    public function markMessagesAsRead($chatId)
    {
        Message::where('chat_id', $chatId)
            ->where('sender_id', '!=', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);
    }

    public function render()
    {
        return view('livewire.user-chat');
    }
}