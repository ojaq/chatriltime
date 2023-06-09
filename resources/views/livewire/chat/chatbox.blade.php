<div>
    {{-- The best athlete wants his opponent at his best. --}}

    @if ($selected_conversation)
        
    <div class="chatbox_header">
        <div class="return">
            <i class="bi bi-arrow-left"></i>
        </div>
        
        <div class="img_container">
            <img src="https://ui-avatars.com/api/?name={{ $receiver_instance->name }}" alt="">
        </div>

        <div class="name">{{ $receiver_instance->name }}</div>
        <div class="info">
            <div class="info_item">
                <i class="bi bi-telephone-fill"></i>
            </div>
            <div class="info_item">
                <i class="bi bi-image"></i>
            </div>
            <div class="info_item">
                <i class="bi bi-info-circle"></i>
            </div>
        </div>
    </div>

    <div class="chatbox_body">

        @foreach ($messages as $message)
            <div wire:key='{{ $message->id }}' class="msg_body {{ auth()->id() == $message->sender_id ? 'msg_body_me' : 'msg_body_receiver' }}" style="width=80%;max-width:max-content">
                {{ $message->body }}
                <div class="msg_body_footer">
                    <div class="date">{{ $message->created_at->format('m:i a') }}</div>
                    <div class="read">
                        <i class="bi bi-check"></i>
                    </div>
                </div>    
            </div>    
        @endforeach

    </div>

    <script>
        $('.chatbox_body').on('scroll', function () {
            var top = $('.chatbox_body').scrollTop()
            if(top == 0){
                window.livewire.emit('loadmore')
            }
        })
    </script>

    @else
    <div class="fs-4 text-center text-primary mt-5">
        no conversation selected
    </div>
    @endif

    <script>
        window.addEventListener('rowChatToBottom', event =>{
            $('.chatbox_body').scrollTop($('.chatbox_body')[0].scrollHeight)
        })
    </script>
    
</div>
