<div
    class="min-h-screen antialiased font-normal fi-body fi-panel-admin bg-gray-50 text-gray-950 dark:bg-gray-950 dark:text-white">

    <div class="p-5">
        <header class="flex flex-col gap-3 px-6 py-4 fi-section-header">
            <div class="flex items-center gap-3">
                <div class="grid flex-1 gap-y-1">
                    <h3
                        class="text-base font-semibold leading-6 fi-section-header-heading text-gray-950 dark:text-white">
                        pages
                    </h3>
                </div>
                <a href="{{ route('admin.createpage') }}"
                    style="--c-400:var(--primary-400);--c-500:var(--primary-500);--c-600:var(--primary-600);"
                    class="fi-btn relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg fi-color-custom fi-btn-color-primary fi-color-primary fi-size-md fi-btn-size-md gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-custom-600 text-white hover:bg-custom-500 focus-visible:ring-custom-500/50 dark:bg-custom-500 dark:hover:bg-custom-400 dark:focus-visible:ring-custom-400/50 fi-ac-action fi-ac-btn-action">
                    <span class="fi-btn-label">
                        New page
                    </span>
                </a>
            </div>
        </header>


        <div
            class="overflow-hidden bg-white divide-y divide-gray-200 shadow-sm fi-ta-ctn rounded-xl ring-1 ring-gray-950/5 dark:divide-white/10 dark:bg-gray-900 dark:ring-white/10">
       
            <div
                class="relative overflow-x-auto divide-y divide-gray-200 fi-ta-content dark:divide-white/10 dark:border-t-white/10">
                <table class="w-full divide-y divide-gray-200 table-auto fi-ta-table text-start dark:divide-white/5">
                    <thead class="divide-y divide-gray-200 dark:divide-white/5">
                        <tr class="bg-gray-50 dark:bg-white/5">
                            <th class="fi-ta-header-cell px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 fi-table-header-cell-number"
                                style=";">
                                <div class="flex items-center justify-start w-full group gap-x-1 whitespace-nowrap">
                                    <span
                                        class="text-sm font-semibold fi-ta-header-cell-label text-gray-950 dark:text-white">
                                        #
                                    </span>
                                </div>
                            </th>

                            <th class="fi-ta-header-cell px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 fi-table-header-cell-customer.name"
                                style=";">
                                <div class="flex items-center justify-start w-full group gap-x-1 whitespace-nowrap">
                                    <span
                                        class="text-sm font-semibold fi-ta-header-cell-label text-gray-950 dark:text-white">
                                        Title
                                    </span>
                                </div>
                            </th>





                            <th class="fi-ta-header-cell px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 fi-table-header-cell-total-price"
                                style=";">
                                <div class="flex items-center justify-start w-full group gap-x-1 whitespace-nowrap">
                                    <span
                                        class="text-sm font-semibold fi-ta-header-cell-label text-gray-950 dark:text-white">

                                    </span>
                                </div>
                            </th>



                            <th class="fi-ta-header-cell px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 fi-table-header-cell-created-at"
                                style=";">
                                <span class="flex items-center justify-start w-full group gap-x-1 whitespace-nowrap">
                                    <span
                                        class="text-sm font-semibold fi-ta-header-cell-label text-gray-950 dark:text-white">

                                    </span>
                                </span>
                            </th>
                            <th class="fi-ta-header-cell px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 fi-table-header-cell-created-at"
                                style=";">
                                <span class="flex items-center justify-start w-full group gap-x-1 whitespace-nowrap">
                                    <span
                                        class="text-sm font-semibold fi-ta-header-cell-label text-gray-950 dark:text-white">

                                    </span>
                                </span>
                            </th>
                            <th class="fi-ta-header-cell px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 fi-table-header-cell-created-at"
                                style=";">
                                <span class="flex items-center justify-start w-full group gap-x-1 whitespace-nowrap">
                                    <span
                                        class="text-sm font-semibold fi-ta-header-cell-label text-gray-950 dark:text-white">

                                    </span>
                                </span>
                            </th>

                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200 whitespace-nowrap dark:divide-white/5">
                        @foreach ($pages as $page)
                            <tr
                                class="fi-ta-row [@media(hover:hover)]:transition [@media(hover:hover)]:duration-75 hover:bg-gray-50 dark:hover:bg-white/5">
                                <td class="p-0 fi-ta-cell first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3 fi-table-cell-number"
                                    wire:key="QBsSrdIO7MlisZRm5A63.table.record.10.column.number">
                                    <div class="fi-ta-col-wrp">
                                        <a href
                                            class="flex justify-start w-full disabled:pointer-events-none text-start">
                                            <div class="grid w-full px-3 py-4 fi-ta-text gap-y-1">
                                                <div class="flex">
                                                    <div class="flex max-w-max" style>
                                                        <div class="fi-ta-text-item inline-flex items-center gap-1.5">
                                                            <span
                                                                class="text-sm leading-6 fi-ta-text-item-label text-gray-950 dark:text-white"
                                                                style>
                                                                {{ $page->id }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </td>

                                <td
                                    class="fi-ta-cell p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3 fi-table-cell-customer.name">
                                    <div class="fi-ta-col-wrp">
                                        <a href
                                            class="flex justify-start w-full disabled:pointer-events-none text-start">
                                            <div class="grid w-full px-3 py-4 fi-ta-text gap-y-1">
                                                <div class="flex">
                                                    <div class="flex max-w-max" style>
                                                        <div class="fi-ta-text-item inline-flex items-center gap-1.5">
                                                            <span
                                                                class="text-sm leading-6 fi-ta-text-item-label text-gray-950 dark:text-white"
                                                                style>
                                                                {{ $page->title }} </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </td>



                                <td
                                    class="p-0 fi-ta-cell first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3 fi-ta-actions-cell">
                                    <div class="px-3 py-4 whitespace-nowrap">
                                        <div class="flex items-center justify-end gap-3 fi-ta-actions shrink-0">
                                            <a href="{{ route('admin.pages.update', $page->slug) }}"
                                                class="relative inline-flex items-center justify-center gap-1 outline-none fi-link group/link fi-size-sm fi-link-size-sm fi-color-custom fi-color-primary fi-ac-action fi-ac-link-action">
                                                <svg style="--c-400:var(--primary-400);--c-600:var(--primary-600);"
                                                    class="w-4 h-4 fi-link-icon text-custom-600 dark:text-custom-400"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                    fill="currentColor" aria-hidden="true" data-slot="icon">
                                                    <path
                                                        d="M17 21V17H7V21H5V16C5 15.4477 5.44772 15 6 15H18C18.5523 15 19 15.4477 19 16V21H17ZM7 3V7H17V3H19V8C19 8.55228 18.5523 9 18 9H6C5.44772 9 5 8.55228 5 8V3H7ZM2 9L6 12L2 15V9ZM22 9V15L18 12L22 9Z">
                                                    </path>
                                                </svg>

                                                <span
                                                    class="text-sm font-semibold group-hover/link:underline group-focus-visible/link:underline text-custom-600 dark:text-custom-400"
                                                    style="--c-400:var(--primary-400);--c-600:var(--primary-600);">

                                                    update page
                                                </span>
                                            </a>


                                        </div>


                                    </div>
                                </td>





                                <td
                                    class="p-0 fi-ta-cell first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3 fi-ta-actions-cell">
                                    <div class="px-3 py-4 whitespace-nowrap">
                                        <div class="flex items-center justify-end gap-3 fi-ta-actions shrink-0">
                                            <a wire:click='deletePage({{ $page->id }})'
                                                class="relative inline-flex items-center justify-center gap-1 outline-none fi-link group/link fi-size-sm fi-link-size-sm fi-color-custom fi-color-primary fi-ac-action fi-ac-link-action">
                                                <svg style="--c-400:#dc2626;--c-600:#dc2626;"
                                                    class="w-4 h-4 fi-link-icon text-custom-600 dark:text-custom-400"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                    fill="#dc2626" aria-hidden="true" data-slot="icon">
                                                    <path
                                                        d="M 10 2 L 9 3 L 3 3 L 3 5 L 21 5 L 21 3 L 15 3 L 14 2 L 10 2 z M 4.3652344 7 L 6.0683594 22 L 17.931641 22 L 19.634766 7 L 4.3652344 7 z">
                                                    </path>
                                                </svg>
                                                <span
                                                    class="text-sm font-semibold group-hover/link:underline group-focus-visible/link:underline text-custom-600 dark:text-custom-400"
                                                    style="color:#dc2626">
                                                    Delete
                                                </span>
                                            </a>


                                        </div>


                                    </div>
                                </td>

                            </tr>
                        @endforeach


                    </tbody>

                    <tfoot class="divide-y divide-gray-200 dark:divide-white/5">
                        <tr class="bg-gray-50 dark:bg-white/5">
                            <td class="px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 fi-ta-footer-cell"
                                colspan="7">
                                {{ $pages->links('pagination::tailwind') }}
                            </td>
                        </tr>
                    </tfoot>



                </table>

            </div>

        </div>
    </div>
</div>
