<?php

namespace App\Livewire\Admin\Medialibrary;

use Illuminate\Support\Facades\Log;
use Livewire\Component;

class DeleteConfirmation extends Component
{
    public $isOpen = false;

    public $itemToDelete = null;

    protected $listeners = ['showDeleteModal' => 'openModal', 'deleteItemsConfirmed' => 'deleteItems'];

    public function openModal($itemIds)
    {

        $this->itemToDelete = $itemIds;
        $this->isOpen = true;
    }

    public function deleteItem()
    {
        Log::info('deleteItem called with itemToDelete: '.json_encode($this->itemToDelete));

        if (is_array($this->itemToDelete)) {
            // If itemToDelete is an array, dispatch deleteItemsConfirmed event
            $this->dispatch('deleteItemsConfirmed', ['itemIds' => $this->itemToDelete]);
        } else {
            // If itemToDelete is a single item, dispatch deleteItemConfirmed event
            $this->dispatch('deleteItemConfirmed', ['itemId' => $this->itemToDelete]);
        }
        // Close the modal after dispatching the event
        $this->isOpen = false;
    }

    public function render()
    {
        return view('livewire.admin.medialibrary.delete-confirmation');
    }
}
