<?php

namespace App\Livewire\Admin\Menu;

use App\Models\Menu;
use Livewire\Component;

class ShowMenus extends Component
{
    public $menus;

    public $editMenuId;

    public $updatedName;

    public $selectedPosition;

    public $selectedMenuId; // Track the ID of the selected menu

    public $newMenuName; // New menu name input

    public $newMenuPosition; // New menu position input

    public $menu1;

    public function mount()
    {
        $this->menus = Menu::all();
    }

    public function deleteMenu($id)
    {
        Menu::destroy($id);
        $this->menus = Menu::all();
    }

    public function test($id)
    {
        $this->selectedMenuId = $id; // Set the selected menu ID
        $this->menu1 = Menu::find($id);
        $data = json_decode($this->menu1->data, true);
        // Add decoded data to the menu item
        $this->menu1->data = $data;
    }

    public function toggleEditForm($id)
    {
        $data = Menu::find($id);
        $this->editMenuId = $this->editMenuId === $id ? null : $id;
        $this->updatedName = $data->name;
        $this->selectedPosition = $data->position;
    }

    public function updateMenu()
    {
        if ($this->updatedName && $this->editMenuId) {
            $menu = Menu::findOrFail($this->editMenuId);
            $menu->name = $this->updatedName;
            $menu->position = $this->selectedPosition;
            $menu->save();

            $this->editMenuId = null;
            $this->updatedName = null;

            $this->menus = Menu::all();
        }
    }

    public function editMenu($id)
    {
        $menu = Menu::findOrFail($id);

        return redirect()->route('admin.menu.builder', ['id' => $menu->id]);
    }

    public function createMenu()
    {
        if ($this->newMenuName && $this->newMenuPosition) {
            Menu::create([
                'name' => $this->newMenuName,
                'position' => $this->newMenuPosition,
                'data' => '[]',
                //                 'data' => '[{
                //     "text": "Opcion2",
                //     "href": "",
                //     "icon": "fa fa-bar-chart-o",
                //     "target": "_self",
                //     "title": ""
                //   }]'
            ]);

            // Reset input values after creating menu
            $this->newMenuName = '';
            $this->newMenuPosition = '';

            // Refresh the menus data
            $this->menus = Menu::all();
        }

    }

    public function render()
    {
        // Filter menus to only include the selected menu
        $selectedMenus = $this->menus->where('id', $this->selectedMenuId);

        return view('livewire.admin.menu.show-menus', [
            'selectedMenus' => $selectedMenus,
        ])->layout('components.admin');
    }
}
