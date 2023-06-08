<div>
    {{-- The Master doesn't talk, he acts. --}}
    
    <div class="chatlist_header">
        <div class="title">Chat</div>
        <div class="img_container">
            <img src="https://ui-avatars.com/api/?background=0D8ABC&color=fff&name={{ auth()->user()->name }}" alt="">
        </div>
    </div>

    @if (count($conversations) > 0)

    @foreach ($conversations as $conversation)

    <div class="chatlist_body">
        <div class="chatlist_item" wire:click="$emit('chatUS', {{ $conversation }}, {{ $this->getCUI($conversation, $name = 'id') }})">
            <div class="chatlist_img_container">
                <img src="https://ui-avatars.com/api/?name={{ $this->getCUI($conversation, $name = 'name') }}" alt="">
            </div>

            <div class="chatlist_info">
                <div class="top_row">
                    <div class="list_username">{{ $this->getCUI($conversation, $name = 'name') }}</div>
                    <span class="date">{{ $conversation->messages->last()->created_at->shortAbsoluteDiffForHumans() }}</span>
                </div>
    
                <div class="bottom_row">
                    <div class="message_body text-truncate">
                        {{ $conversation->messages->last()->body }}
                    </div>
    
                    <div class="unread_count">100</div>
                </div>
            </div>
        </div>
    </div>

    @endforeach

    @else
    you have no conversation
    @endif

</div>
