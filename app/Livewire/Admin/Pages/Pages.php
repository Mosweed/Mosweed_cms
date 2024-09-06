<?php

namespace App\Livewire\Admin\Pages;

use App\Models\pages as ModelsPages;
use Livewire\Component;
use Livewire\WithPagination;

class Pages extends Component
{
    use WithPagination;

    public function deletePage($id)
    {
        $page = ModelsPages::find($id);
        $page->delete();
    }

    public function render()
    {

        return view('livewire.admin.pages.pages', [
            'pages' => ModelsPages::paginate(10),
        ])->layout('components.admin');
    }
}
