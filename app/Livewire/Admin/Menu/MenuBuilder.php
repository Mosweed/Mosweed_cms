<?php

namespace App\Livewire\Admin\Menu;

use App\Models\Menu;
use Illuminate\Http\Request;
use Livewire\Component;

class MenuBuilder extends Component
{
    public $menus;

    public $id;

    protected $listeners = ['MenuWerwerken' => 'MenuWerwerken', 'tests' => 'tests', 'createMenu' => 'createMenu'];

    public function MenuWerwerken($menuData)
    {

        // $menuData = str_replace('&quot;', '\\', $menuData);

        // dd($menuData);
        $data = Menu::find($this->id);
        $data->data = json_decode($menuData, true);
        $data->save();

        // $this->menus = $data;
        //  $this->render();

        //

        return redirect()->route('admin.show.menus');
    }

    public function createMenu()
    {
        //dd('createMenu');
        $name = 'New Menu';
        Menu::create(['name' => $name, 'data' => '[{
    "text": "Opcion2",
    "href": "",
    "icon": "fa fa-bar-chart-o",
    "target": "_self",
    "title": ""
  }]']);

        return redirect()->route('admin.show.menus');
    }

    public function render(Request $request)
    {
        if ($request->id) {
            $this->id = $request->id;
            $data = Menu::find($this->id);
        } else {
            $this->id = 1;
            $data = Menu::find($this->id);
        }

        $this->menus = $data;

        return view('livewire.admin.menu.menu-builder')->layout('components.admin');
    }
}
