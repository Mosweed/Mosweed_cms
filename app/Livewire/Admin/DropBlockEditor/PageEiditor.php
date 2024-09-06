<?php

namespace App\Livewire\Admin\DropBlockEditor;

use App\Models\pages;
use Illuminate\Http\Request;
use Livewire\Component;

class PageEiditor extends Component
{
    public $page;

    public function mount(Request $request)
    {
        if ($request->page) {
            $this->page = pages::where('slug', $request->page)->first();

            if (! $this->page) {
                abort(404);
            }

        }
    }

    public function render()
    {
        return view('livewire.admin.dropblockeditor.page-eiditor')->layout('components.admin');
    }
}
