<div class="flex min-h-screen p-4 dark:bg-gray-950 dark:text-white ">
    <div class="{{ $selectedPicture ? 'w-2/3' : 'w-full' }} space-y-4 pb-5">

        <div x-data="{ open: false }" class="rounded-md ">

            <div class="p-4 bg-gray-100 rounded-md shadow-md dark:bg-gray-800">
                <button x-show="!open" x-on:click="open = true" class="w-full border-blue-500 rounded-md ">
                    Add image
                </button>

                <form x-show="open" wire:submit.prevent="save" class="pb-5 space-y-4">
                    @csrf
                    <input type="file" wire:model="photo" class="w-full px-3 py-2 border rounded-md">

                    @error('photo')
                        <span x-data x-init="showError = true;
                        setTimeout(() => showError = false, 4000)" x-show="showError"
                            class="text-red-500 error">{{ $message }}</span>
                    @enderror


                    <!-- Tags Input -->
                    <div class="flex flex-wrap">
                        @foreach ($allTags as $tag)
                            <div class="flex items-center mb-2 space-x-2" wire:key="tag_{{ $tag->id }}">
                                <input type="checkbox" wire:model="tags" value="{{ $tag->id }}"
                                    class="w-5 h-5 text-blue-600 form-checkbox">
                                <label>{{ $tag->name }}</label>
                            </div>
                        @endforeach
                    </div>

                    <!-- Title Input -->
                    <div class="mb-2">Title</div>
                    <input type="text" wire:model="fileTitle"
                        class="w-full px-3 py-2 border rounded-md dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500">

                    <!-- Alt Text Input -->
                    <div class="mb-2">Alt text</div>
                    <input type="text" wire:model="altText"
                        class="w-full px-3 py-2 border rounded-md dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500">

                    <button type="submit"
                        class="w-full px-4 py-2 mt-4 bg-blue-400 border border-blue-500 rounded-md hover:bg-blue-300"
                        wire:loading.attr="disabled" wire:target="photo"
                        wire:loading.class="opacity-50 cursor-not-allowed">
                        Save photo
                    </button>

                    <button type="button" x-on:click="open = false" class="w-full border-blue-500 rounded-md">
                        Cancel
                    </button>

                    <span wire:loading wire:target="photo">Uploading...</span>
                    <div x-data="{ open: false, message: '' }"
                        x-on:notifytop.window="message = $event.detail; open = true; setTimeout(() => open = false, 4000)"
                        x-show="open" class="px-4 py-3 text-green-700 bg-green-100 border border-green-400 rounded">
                        <p x-text="message"></p>
                    </div>
                </form>
            </div>

            <div class="p-4 mt-4 bg-gray-100 rounded-md shadow-md dark:bg-gray-800">

                <div class="pb-4 mt-4">
                    <button wire:click="generateMissingResizedImages"
                        class="px-4 py-2 mb-2 bg-gray-300 border rounded-md dark:bg-gray-700 dark:border-gray-600 hover:bg-gray-500 ">Generate missing images for everything</button>
                    <!-- Delete Selected Button -->
                    <form wire:submit.prevent="confirmDeleteSelected">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-red-500 border border-red-500 rounded-md ">
                            Delete Selected
                        </button>
                    </form>
                </div>
                @livewire('admin.medialibrary.delete-confirmation')


                <!--ingeladeimages-->
                <div class="flex flex-wrap gap-4">
                    @foreach ($pictures as $picture)
                        <div class="relative overflow-hidden bg-white rounded-lg shadow-lg h-36 w-36 dark:bg-gray-700"
                            wire:key="picture_{{ $picture->id }}">

                            <!-- Checkbox -->
                            <input type="checkbox" wire:model="selectedPictures" value="{{ $picture->id }}"
                                class="absolute z-10 top-2 right-2">

                            <img src="{{ $picture->image_url }}" alt="{{ $picture->fileTitle }}"
                                class="object-cover w-full h-full rounded-md cursor-pointer"
                                wire:click="selectPicture({{ $picture->id }})">

                        </div>
                    @endforeach
                </div>


                <!-- Pagination Links -->
                <div class="mt-4">
                    {{ $pictures->links('pagination::tailwind') }}
                </div>
            </div>
        </div>
    </div>
    <!-- DETAILS -->

    @if ($selectedPicture)
        <div class="w-1/3 p-6 ml-4 bg-gray-100 rounded-md shadow-md dark:bg-gray-800"
            wire:key="selectedPicture_{{ $selectedPicture->id }}">

            <div class="flex items-center justify-between">
                <h2 class="mb-2 text-xl font-bold">{{ $selectedPicture->fileTitle }}</h2>
                <button wire:click="cancel"
                    class="px-3 py-2 text-xs font-bold text-gray-800 bg-gray-300 rounded-full hover:bg-gray-400">
                    X
                </button>
            </div>

            <div class="relative w-full h-64 overflow-hidden">
                <img src="{{ $selectedPicture->image_url }}" alt="{{ $selectedPicture->fileTitle }}"
                    class="absolute top-0 bottom-0 left-0 right-0 object-contain w-full h-full m-auto">
            </div>

            <h2 class="mb-2 text-lg font-semibold">Tags</h2>
            <div class="flex flex-wrap mb-4">
                @forelse ($selectedPicture->tags as $tag)
                    <div class="px-2 py-1 mb-2 mr-2 text-gray-800 bg-gray-200 rounded-full "
                        wire:key="selectedPictureTag_{{ $tag->id }}">
                        <span>{{ $tag->name }}</span>
                        <!-- Button to remove tag -->
                        <button wire:click="removeTag({{ $selectedPicture->id }}, {{ $tag->id }})"
                            class="ml-1 focus:outline-none">

                        </button>
                    </div>
                @empty
                    <p>No tags associated with this picture.</p>
                @endforelse
            </div>

            <!-- Form for adding tags -->
            <form wire:submit.prevent="saveTags" class="mb-4">
                @csrf
                <div class="mb-4">
                    <label for="tag" class="block mb-2">Select Tags:</label>
                    <select wire:model="tags" multiple id="tag"
                        class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500">
                        @foreach ($allTags as $tag)
                            @unless ($selectedPicture->tags->contains($tag))
                                <option value="{{ $tag->id }}"wire:key="tagOption_{{ $tag->id }}">
                                    {{ $tag->name }}</option>
                            @endunless
                        @endforeach
                    </select>
                </div>
                <button type="submit"
                    class="px-4 py-2 mt-4 bg-blue-400 border border-blue-500 rounded-md hover:bg-blue-300">
                    Save tags
                </button>
            </form>

            <div class="mb-4">
                <div class="font-bold">
                    Title:
                </div>
                @if ($selectedPicture)
                    <input type="text" wire:model.defer="fileTitle"
                        class="w-full px-3 py-2 border rounded-md dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500">
                @endif
                <button wire:click="updateFileTitle"
                    class="px-4 py-2 mt-4 bg-blue-400 border border-blue-500 rounded-md hover:bg-blue-300">Wijzig</button>
            </div>

            <div class="mb-4">
                <div class="font-bold">
                    Alt Text:
                </div>
                @if ($selectedPicture)
                    <input type="text" wire:model.defer="altText"
                        class="w-full px-3 py-2 mt-2 border rounded-md dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500">
                @endif
                <button
                    wire:click="updateAltText"class="px-4 py-2 mt-4 bg-blue-400 border border-blue-500 rounded-md hover:bg-blue-300">Wijzig</button>
            </div>



            <h2 class="mb-2 text-lg font-semibold">Resized Images</h2>
            <div class="flex flex-wrap mb-4">
                @forelse ($selectedPicture->resizedImages as $resizedImage)
                    <div class="flex items-center">
                        <div class="px-2 py-1 mb-2 mr-2 text-gray-800 bg-gray-200 rounded-t-sm rounded-tr-sm sm:w-auto dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 "
                            wire:key="selectedPictureResizedImage_{{ $resizedImage->id }}">
                            <div class="overflow-hidden text-xs break-words whitespace-normal overflow-ellipsis">
                                {{ url('storage/' . $resizedImage->picture_id . '/resized_images/' . basename($resizedImage->path)) }}
                            </div>
                        </div>

                        <button wire:click="deleteResizedImage({{ $resizedImage->id }})"
                            class="text-gray-600 hover:text-red-800">
                            X
                        </button>
                    </div>
                @empty
                    <p>No resized images found</p>
                @endforelse
                <button wire:click="generateMissingResizedImagesForSelected"
                    class="px-4 py-2 mt-4 bg-blue-400 border border-blue-500 rounded-md hover:bg-blue-300">
                    Generate missing resized images
                </button>
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

            <div x-data="{ open: false, message: '' }"
                x-on:notify.window="message = $event.detail; open = true; setTimeout(() => open = false, 5000)"
                x-show="open"
                class="fixed px-4 py-3 text-green-700 bg-green-100 border border-green-400 rounded bottom-5 right-5">
                <p x-text="message"></p>
            </div>

            <div class="flex mt-4 space-x-4">
                <button wire:click="cancel"
                    class="px-4 py-2 font-bold text-gray-800 bg-gray-300 rounded-l hover:bg-gray-400">
                    Cancel
                </button>
                <button wire:click="confirmDelete({{ $selectedPicture->id }})"
                    class="px-4 py-2 font-bold text-white bg-red-500 rounded-r hover:bg-red-700">
                    Delete
                </button>
            </div>



        </div>

    @endif

</div>
