<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    @if ($selected_conversation)
    <form action="" wire:submit.prevent='sendMessage'>
        <div class="chatbox_footer">
            <div class="custom_form_group">
                <input wire:model='body' type="text" class="control" placeholder="write message">
                <button class="submit" type="submit">Send</button>
            </div>
        </div>
    </form>
    @endif
</div>
