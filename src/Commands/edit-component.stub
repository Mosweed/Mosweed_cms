<div >
    <div class="space-y-4">
        <div>
            <div class="mb-1">Title</div>
            <input type="text"  value="{{ $data['title'] }}" wire:change="blockUpdated({{ $position }}, 'title', $event.target.value)"
                class="w-full px-3 py-1 text-black border border-gray-200 rounded-md">
        </div>

        <div>
            <div class="mb-1">Content</div>
            <textarea wire:change="blockUpdated({{ $position }}, 'content', $event.target.value)"   class="w-full px-3 py-1 text-black border border-gray-200 rounded-md">{{ $data['content'] }}</textarea>

        </div>
    </div>
    <div>
        <label class="mb-1">{{ $position }}</label>
    </div>
</div>
