<div x-data="{ isOpen: @entangle('isOpen').live }" x-show="isOpen" style="display: none;">
    <div class="fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" x-show="isOpen">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <div x-show="isOpen"
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-5xl sm:w-full"
                @click.away="isOpen = false">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 flex">
                    <!-- Image selection grid -->
                    <div class="flex-1">
                        <div class="flex flex-wrap -mx-2">
                            @foreach ($pictures as $picture)
                                <div class="relative overflow-hidden shadow-lg rounded-lg bg-white h-36 w-36 m-2"
                                    wire:key="picture_{{ $picture->id }}"
                                    wire:click="selectPicture({{ $picture->id }})"
                                    :class="{ 'border-4 border-blue-500': selectedPictureId === {{ $picture->id }} }">
                                    <img src="{{ $picture->image_url }}" alt="{{ $picture->fileTitle }}"
                                        class="w-full h-full rounded-md object-cover cursor-pointer">
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Details section -->
                    @if ($selectedPicture)
                        <div class="w-1/3 ml-4 rounded-md bg-white p-6"
                            wire:key="selectedPicture_{{ $selectedPicture->id }}">
                            <div class="flex justify-between items-center">
                                <h2 class="text-xl font-bold mb-2">{{ $selectedPicture->fileTitle }}</h2>
                                <button wire:click="cancel"
                                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-3 rounded-full text-xs">X</button>
                            </div>
                            <div class="w-full h-64 overflow-hidden relative">
                                @if ($selectedPictureUrl)
                                    <img id="selectedImage{{ $instanceId }}" src="{{ $selectedPictureUrl }}"
                                        class="w-64 h-64 object-contain">
                                @endif

                            </div>
                            <h2 class="text-lg font-semibold mb-2">Tags</h2>
                            <div class="flex flex-wrap mb-4">
                                @forelse ($selectedPicture->tags as $tag)
                                    <div class="bg-gray-200 text-gray-800 px-2 py-1 rounded-full mr-2 mb-2"
                                        wire:key="selectedPictureTag_{{ $tag->id }}">
                                        <span>{{ $tag->name }}</span>
                                    </div>
                                @empty
                                    <p>No tags associated with this picture.</p>
                                @endforelse
                            </div>
                            <h2 class="text-lg font-semibold mb-2">Resized Images</h2>
                            <div class="flex flex-wrap mb-4">
                                @forelse ($selectedPicture->resizedImages as $resizedImage)
                                    <div class="bg-gray-200 text-gray-800 px-2 py-1 rounded-t-sm rounded-tr-sm mr-2 mb-2 sm:w-auto cursor-pointer"
                                        wire:key="selectedPictureResizedImage_{{ $resizedImage->id }}"
                                        wire:click="selectResizedImage('{{ $resizedImage->path }}')"
                                        :class="{ 'border-4 border-blue-500': selectedResizedImagePath === '{{ $resizedImage->path }}' }">
                                        <div class="whitespace-normal flex-shrink-0 mr-2 overflow-auto">
                                            <span>{{ basename($resizedImage->path) }}</span>
                                        </div>
                                    </div>
                                @empty
                                    <p>Geen resized afbeeldingen gevonden</p>
                                @endforelse
                            </div>
                            <div>
                                <p class="mb-2">File Size:
                                    @if ($selectedPicture->fileSize < 1024 * 1024)
                                        {{ round($selectedPicture->fileSize / 1024, 1) }} KB
                                    @else
                                        {{ round($selectedPicture->fileSize / 1024 / 1024, 1) }} MB
                                    @endif
                                </p>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button wire:click="$set('isOpen', false)"
                        class="mr-3 px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 transition duration-150 ease-in-out">
                        Cancel
                    </button>
                    <button wire:click="confirmSelection"
                        class="px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-blue-500 hover:bg-blue-700 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-blue-700 transition duration-150 ease-in-out"
                        :disabled="!selectedPictureId && !selectedResizedImagePath">
                        Confirm
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
