<div class="flex p-4 shadow-md min-h-screen">

    <button wire:click="$dispatch('openModal')"
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-r cursor-pointer">
        Open Modal
    </button>

    @livewire('admin.modalselect.modal', ['instanceId' => $instanceId])

    <div class="mt-4">
        <p>Selected Image:</p>
        @if ($selectedPictureUrl)
            <img id="selectedImage" src="{{ $selectedPictureUrl }}" class="w-64 h-64 object-contain">
        @endif
    </div>

</div>

<script>
    document.addEventListener('pictureSelected', event => {
        console.log('Picture selected event received:', event.detail);
        document.getElementById('selectedImageUrl').innerText = event.detail;
    });
</script>
