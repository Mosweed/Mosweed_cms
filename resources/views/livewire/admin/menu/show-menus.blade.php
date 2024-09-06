

<div class="min-h-screen bg-gray-50 dark:bg-gray-950 text-gray-950 dark:text-white">
    <div class="flex flex-col h-full">

        <!-- Navbar Placeholder -->
        <div class="p-6 bg-blue-700">
            <!-- Navbar Content Here -->
        </div>

        <!-- Main Content Area -->
        <div class="flex-grow p-6">
            <div class="px-6 py-4 bg-white rounded-lg shadow dark:bg-gray-900">
                <h2 class="mb-4 text-2xl font-bold">Menus</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50 dark:bg-gray-800">
                            <tr>
                                <th
                                    class="px-3 py-2 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">
                                    Select</th>
                                <th
                                    class="px-3 py-2 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">
                                    ID</th>
                                <th
                                    class="px-3 py-2 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">
                                    Name</th>
                                <th
                                    class="px-3 py-2 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">
                                    Position</th>
                                <th
                                    class="px-3 py-2 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-900 dark:divide-gray-800">
                            @foreach ($menus as $menu)
                            <tr class="{{ $selectedMenuId == $menu->id ? 'bg-gray-200 dark:bg-gray-700' : '' }}">
                                <td class="px-3 py-2 whitespace-nowrap"><input type="radio" name="radio"
                                        wire:click='test({{ $menu->id }})'></td>
                                <td class="px-3 py-2 whitespace-nowrap">{{ $menu->id }}</td>
                                <td class="px-3 py-2 whitespace-nowrap">{{ $menu->name }}</td>
                                <td class="px-3 py-2 whitespace-nowrap">{{ $menu->position }}</td>
                                <td class="px-3 py-2 whitespace-nowrap">
                                    <button class="px-2 py-1 font-bold text-white bg-blue-500 rounded hover:bg-blue-700"
                                        wire:click="toggleEditForm({{ $menu->id }})">Edit</button>
                                    <button class="px-2 py-1 font-bold text-white bg-red-500 rounded hover:bg-red-700"
                                        wire:click="deleteMenu({{ $menu->id }})">Delete</button>
                                    <button
                                        class="px-2 py-1 font-bold text-white bg-green-500 rounded hover:bg-green-700"
                                        wire:click="editMenu({{ $menu->id }})">Manage</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    <h2 class="text-2xl font-bold">Add New Menu</h2>
                    <form wire:submit.prevent="createMenu" class="flex mt-4">
                        <input type="text" class="w-full rounded-md shadow-sm form-input" wire:model.defer="newMenuName"
                            placeholder="Enter menu name">
                        <select class="ml-2 rounded-md shadow-sm dark:text-gray-800 " wire:model.defer="newMenuPosition">
                            <option  value="">Select position</option>
                            <option value="header">Header</option>
                            <option value="footer">Footer</option>
                        </select>
                        <button class="px-2 py-1 ml-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700"
                            type="submit">Add Menu</button>
                    </form>
                </div>
            </div>
            <div class="font-bold bg-white dark:bg-gray-800">Active Menu
                <!-- Navbar -->
                <nav class="flex items-center justify-between p-4">
                    <div class="hidden w-full lg:block lg:w-auto" id="navbarSupportedContent">
                        @if (isset($menu1) && is_array($menu1->data))
                        <ul class="flex flex-col list-none lg:flex-row lg:ml-auto">
                            @foreach ($menu1->data as $menuItem)
                            @if (is_array($menuItem))
                            <li class="relative nav-item">
                                @if (isset($menuItem['href']))
                                <a href="{{ $menuItem['href'] }}"
                                    class="flex items-center px-3 py-2 text-xs font-bold leading-snug text-gray-800 uppercase dark:text-white hover:opacity-75">
                                    {{ $menuItem['text'] }}
                                </a>
                                @else
                                <span class="flex items-center px-3 py-2 text-xs font-bold leading-snug text-gray-800 uppercase dark:text-white">
                                    {{ $menuItem['text'] }}
                                </span>
                                @endif
                                @if (isset($menuItem['children']))
                                <ul class="absolute hidden pt-1 text-gray-700 bg-white shadow-lg dropdown-menu">
                                    @foreach ($menuItem['children'] as $child)
                                    <li>
                                        @if (isset($child['href']))
                                        <a class="block px-4 py-2 whitespace-no-wrap bg-gray-200 hover:bg-gray-400"
                                            href="{{ $child['href'] }}">{{ $child['text'] }}</a>
                                        @else
                                        <span class="block px-4 py-2 whitespace-no-wrap bg-gray-200 hover:bg-gray-400">
                                            {{ $child['text'] }}
                                        </span>
                                        @endif
                                    </li>
                                    @endforeach
                                </ul>
                                @endif
                            </li>
                            @endif
                            @endforeach
                        </ul>
                        @endif
                    </div>
                </nav>
            </div>
        </div>

       

    <style>
        /* Custom CSS for hover dropdown */
        .nav-item .dropdown-menu {
            display: none;
            transition: opacity 0.5s linear, visibility 0s 0.5s;
            visibility: hidden;
            opacity: 0;
        }

        .nav-item:hover .dropdown-menu {
            display: block;
            visibility: visible;
            opacity: 1;
            transition: opacity 0.5s linear, visibility 0s 0s;
        }
    </style>
</div>