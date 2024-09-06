<?php

namespace App\Livewire\Admin\Modalselect;

use App\Models\Picture;
use Livewire\Component;

class Modal extends Component
{
    public $isOpen = false;

    public $pictures = [];

    public $selectedPicture = null;

    public $selectedPictureId = null;

    public $selectedResizedImagePath = null;

    public $selectedPictureUrl = null;

    public $instanceId;

    protected $listeners = ['openModal' => 'showModal'];

    public function mount($instanceId)
    {
        $this->instanceId = $instanceId;
    }

    public function openModalWithButtonId($buttonId)
    {
        $this->buttonId = $buttonId;
        $this->isOpen = true;
        $this->loadPictures();
    }

    public function showModal()
    {
        $this->isOpen = true;
        $this->loadPictures();
    }

    public function loadPictures()
    {
        $this->pictures = Picture::all();
    }

    public function selectPicture($pictureId)
    {
        $this->selectedPicture = Picture::find($pictureId);
        $this->selectedPictureId = $pictureId;
        $this->selectedResizedImagePath = null; // Reset resized image selection
        $filename = basename($this->selectedPicture->image_url);
        $this->selectedPictureUrl = url('storage/'.$this->selectedPicture->id.'/'.$filename);
    }

    public function selectResizedImage($path)
    {
        $filename = basename($path);
        $this->selectedResizedImagePath = url('storage/'.$this->selectedPictureId.'/resized_images/'.$filename);
    }

    public function confirmSelection()
    {
        if ($this->selectedResizedImagePath) {
            $this->dispatch('pictureSelected', $this->selectedResizedImagePath);
        } else {
            $this->dispatch('pictureSelected', $this->selectedPictureUrl);
        }
        $this->isOpen = false;
    }

    public function cancel()
    {
        $this->selectedPicture = null;
        $this->selectedPictureId = null;
        $this->selectedResizedImagePath = null;
        $this->selectedPictureUrl = null;
    }

    public function render()
    {
        return view('livewire.admin.modalselect.modal', ['pictures' => $this->pictures]);
    }
}
