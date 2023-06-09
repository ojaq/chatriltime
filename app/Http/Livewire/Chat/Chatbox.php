<?php

namespace App\Http\Livewire\Chat;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Livewire\Component;

class Chatbox extends Component
{
    public $selected_conversation;
    public $receiver_instance;
    public $message_count;
    public $messages;
    public $paginateVar = 10;
    protected $listeners = ['loadConversation','pushMessage','loadmore'];

    public function loadmore(){
        $this->paginateVar = $this->paginateVar + 10;

        $this->message_count = Message::where('conversation_id', $this->selected_conversation->id)->count();
        $this->messages = Message::where('conversation_id', $this->selected_conversation->id)
        ->skip($this->message_count - $this->paginateVar)
        ->take($this->paginateVar)->get();
    }

    public function pushMessage($messageId){
        $newMessage = Message::find($messageId);
        $this->messages->push($newMessage);

        $this->dispatchBrowserEvent('rowChatToBottom');
    }

    public function loadConversation(Conversation $conversation,User $receiver) {
        // dd($conversation, $receiver);
        $this->selected_conversation = $conversation;
        $this->receiver_instance = $receiver;

        $this->message_count = Message::where('conversation_id', 
        $this->selected_conversation->id)->count();
        $this->messages = Message::where('conversation_id', 
        $this->selected_conversation->id)
        ->skip($this->message_count - $this->paginateVar)
        ->take($this->paginateVar)->get();

        $this->dispatchBrowserEvent('chatSelected');
    }

    public function render() {
        return view('livewire.chat.chatbox');
    }
}
