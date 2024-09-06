<div x-data="{ is_open: @entangle('isOpen').live }" x-show="is_open">
    <div class="fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h2 class="text-lg leading-6 font-medium text-gray-900"> Weet je zeker dat je deze selectie wilt
                        verwijderen?
                    </h2>
                    <div class="mt-5 sm:mt-5">
                        <button wire:click="deleteItem"
                            class="px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-red-600 hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-700 transition duration-150 ease-in-out">Ja,
                            verwijder</button>
                        <button wire:click="$set('isOpen', false)"
                            class="ml-3 px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 transition duration-150 ease-in-out">Nee,
                            annuleer</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
