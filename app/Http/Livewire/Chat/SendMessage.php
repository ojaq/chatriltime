<?php

namespace App\Http\Livewire\Chat;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Livewire\Component;

class SendMessage extends Component
{
    public $selected_conversation;
    public $receiver_instance;
    public $body;
    protected $listeners = ['updateSendMessage', 'sendMessage'];

    public function updateSendMessage(Conversation $conversation, User $receiver) {
        $this->selected_conversation = $conversation;
        $this->receiver_instance = $receiver;
    }

    public function sendMessage() {
        if ($this->body == null) {
            return null;
        }
        $createdMessage = Message::create([
            'conversation_id' => $this->selected_conversation->id,
            'sender_id' => auth()->id(),
            'receiver_id' => $this->receiver_instance->id,
            'body' => $this->body,
        ]);

        $this->selected_conversation->last_time_message = $createdMessage->created_at;
        $this->selected_conversation->save();

        $this->emitTo('chat.chatbox', 'pushMessage', $createdMessage->id);
        $this->emitTo('chat.chatlist', 'refresh');
        $this->reset('body');
    }

    public function render() {
        return view('livewire.chat.send-message');
    }
}
