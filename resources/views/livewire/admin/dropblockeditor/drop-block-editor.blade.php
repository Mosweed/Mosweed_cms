<div class="flex flex-col min-h-screen bg-gray-100 dark:bg-gray-800">
    <div class="flex justify-between px-5 py-5 text-black bg-white border-b dark:bg-gray-700 dark:text-white">
        <div class="flex items-center">
            @if ($logo = config('dropblockeditor.brand.logo', false))
            <div class="mr-2">{!! $logo !!}</div>
            @endif
            <div>{{ $title ?? __('No title') }}</div>
        </div>
        <div class="flex items-center gap-2">
            {{-- <div class="flex gap-2 mx-4"> --}}
                {{-- <button wire:click="undo" @disabled(!$this->canUndo())
                    class="{{ $this->canUndo() ? '' : 'opacity-25' }}" aria-label="Undo change">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 12h-15m0 0l6.75 6.75M4.5 12l6.75-6.75" />
                    </svg>
                </button>
                <button wire:click="redo" @disabled(!$this->canRedo())
                    class="{{ $this->canRedo() ? '' : 'opacity-25' }}" aria-label="Redo change">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                    </svg>
                </button> --}}



                <button wire:click="save"
                    class="px-3 py-1 text-sm text-blue-900 bg-blue-200 rounded dark:text-blue-200 dark:bg-blue-900">
                    Save
                </button>
            </div>
        </div>
        <div class="flex flex-initial h-full grow">
            <div class="relative flex justify-center flex-1">
                <div class="w-full h-full draggable-dropzone--occupied" id="sortable-list">
                    <div drop-placeholder class="h-full min-h-[200px] text-gray-600 dark:text-gray-400 text-lg"
                        id="drop-placeholder">



                        @foreach ($activeBlocks as $index => $activeBlock)
                        <div drag-pl-item data-block="{{ $index }}" wire:key="{{ $activeBlock['id'] }}"
                            class="relative hover:opacity-75 hover:cursor-pointer before:opacity-0 hover:before:opacity-100 before:top-0 before:left-0 before:w-full before:h-full before:border-2 before:border-gray-400 dark:before:border-gray-600 after:absolute after:bg-gray-400 dark:after:bg-gray-600 after:left-0 after:w-full after:opacity-100 after:bottom-0 after:h-[5px]">
                            <div
                                style="background:red;background-color:blanchedalmond;margin:0px auto;max-width:600px;">
                                @component('components.blocks.' . $activeBlock['name'], ['data' => $activeBlock['data'],
                                'position' => $index])
                                @endcomponent
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div
                    class="absolute flex items-center bg-white border rounded-md shadow-sm dark:bg-gray-700 right-4 top-4">
                    <button class="p-2 text-gray-800 dark:text-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25" />
                        </svg>
                    </button>
                </div>
                <div wire:loading class="absolute right-5 bottom-5" x-data="{ isLoading: false }"
                    x-init="$watch('isLoading', value => { if (value) { /* Handle loading started */ } })">
                    <svg class="w-6 h-6 text-gray-400 dark:text-gray-600 animate-spin"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                        </circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                </div>
            </div>
            <aside class="w-[400px] shrink-0 shadow-lg relative bg-gray-300 dark:bg-gray-700">
                <div class="flex flex-col pb-4">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400">
                        <li class="me-2">
                            <button
                                class="inline-block rounded-t-lg border-b-2 border-transparent p-4 @if ($selctedTab == 'blocks') border-gray-300 dark:border-gray-500 text-gray-600 dark:text-gray-200 @endif hover:border-gray-300 dark:hover:border-gray-500 hover:text-gray-600 dark:hover:text-gray-200"
                                type="button" wire:click='changeTab( "blocks" )'>
                                elements
                            </button>
                        </li>
                        <li class="me-2">
                            <button
                                class="inline-block rounded-t-lg border-b-2 border-transparent p-4 @if ($selctedTab == 'settings') border-gray-300 dark:border-gray-500 text-gray-600 dark:text-gray-200 @endif hover:border-gray-300 dark:hover:border-gray-500 hover:text-gray-600 dark:hover:text-gray-200"
                                wire:click='changeTab( "settings" )'>
                                Settings
                            </button>
                        </li>
                    </ul>
                </div>
                <div>
                    <div class="rounded-lg @if ($selctedTab != 'blocks') hidden @endif">
                        <div drop-list x-cloak class="flex flex-col pb-4 @if ($SelectedactiveBlock) hidden @endif ">
                            @php
                            $blockGroups = collect($blocks)
                            ->map(function ($block, $i) {
                            return [
                            'original_index' => $i,
                            'block' => $this->getBlockFromClassName($block['class']),
                            ];
                            })
                            ->groupBy(function ($item) {
                            return $item['block']->getCategory();
                            })
                            ->sortBy(function ($item, $key) {
                            return $key;
                            })
                            ->toArray();
                            @endphp
                            @foreach ($blockGroups as $category => $categoryBlocks)
                            <div class="px-4 pt-4">
                                @if ($category)
                                <h2 class="mb-2 font-medium text-black dark:text-white">{{ $category }}</h2>
                                @endif
                                <div class="grid grid-cols-3 gap-4">
                                    @foreach ($categoryBlocks as $groupedBlock)
                                    @php
                                    $i = $groupedBlock['original_index'];
                                    $block = $groupedBlock['block'];
                                    @endphp
                                    <div drag-item draggable="true" data-block="{{ $i }}"
                                        class="flex flex-col items-center justify-center px-3 py-2 mb-2 text-center bg-gray-100 border border-gray-400 rounded-lg shadow-sm dark:border-gray-600 dark:bg-gray-800 dark:text-white cursor-grab active:cursor-grabbing hover:border-gray-200 dark:hover:border-gray-400">
                                        @if ($block->getIcon())
                                        <div class="mb-1 text-red-800 ">{!! $block->getIcon() !!}</div>
                                        @endif
                                        <span class="text-sm">{{ $block->getTitle() }}</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-red-800 ">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                        </svg>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @if ($SelectedactiveBlock)
                        <div class="mb-4 border-b">
                            <div class="flex items-center justify-between bg-white border-b dark:bg-gray-700">
                                <div class="flex items-center">
                                    <button wire:click="$set('SelectedactiveBlock', false)"
                                        class="p-4 text-gray-500 border-r dark:text-gray-300 hover:text-gray-800 dark:hover:text-gray-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.75 19.5L8.25 12l7.5-7.5" />
                                        </svg>
                                    </button>
                                    <div class="p-4">
                                        <h2 class="flex items-center font-medium">
                                            {{ $SelectedactiveBlock['title'] }}
                                        </h2>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <button wire:click="deleteBlock" aria-label="Delete"
                                        class="p-4 text-gray-500 border-l dark:text-gray-300 hover:text-gray-800 dark:hover:text-gray-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="p-4">
                                {{ __('This block is not editable.') }}
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="@if ($selctedTab != 'settings') hidden @endif rounded-lg p-4" id="settings-example">
                    <div class="pb-8 space-y-4">
                        <div>
                            <label for="title" class="mb-1 text-black dark:text-white">Title</label>
                            <input type="text" wire:model.live='title' value="{{ $title }}" value="{{ $title ?? '' }}"
                                class="w-full px-3 py-1 text-black border border-gray-200 rounded-md dark:text-gray-200 dark:bg-gray-800 dark:border-gray-600">
                            @error('title')
                            <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="pb-8 space-y-4">
                        <div>
                            <label for="title" class="mb-1 text-black dark:text-white ">Slug</label>
                            <input type="text" id="title" wire:model.live='slug' value="{{ $slug }}"
                                class="w-full px-3 py-1 text-black border border-gray-200 rounded-md dark:text-gray-200 dark:bg-gray-800 dark:border-gray-600"
                                disabled>
                            @error('slug')
                            <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="pb-8 space-y-4">
                        <div>
                            <label for="title" class="mb-1 text-black dark:text-white">Status</label>
                            <select wire:model='status'
                                class="w-full px-3 py-1 text-black border border-gray-200 rounded-md dark:text-gray-200 dark:bg-gray-800 dark:border-gray-600">
                                <option value="">Select Status</option>
                                <option value="draft" @if ($status=='draft' ) selected @endif>Draft</option>
                                <option value="published" @if ($status=='published' ) selected @endif>Publish</option>
                            </select>
                            @error('status')
                            <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>

@script
<script>
    window.addEventListener('swal_save', function(e) {



            Swal.fire({
                toast: true,
                position: "top-end",
                icon: "success",
                title: "Data saved successfully",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                background: "black",
                color: 'red',
            }).then(() => {
                Livewire.dispatch('url_updated');

            });


        });
</script>
@endscript