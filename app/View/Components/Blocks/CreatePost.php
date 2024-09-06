<?php

namespace App\View\Components\Blocks;

use App\Classes\BlockClass;

class CreatePost extends BlockClass
{
    public string $title = 'CreatePost';

    public string $icon = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12H12m-8.25 5.25h16.5" /> </svg>';

    public mixed $category = 'test';

    public array $data = [
        'title' => 'Drop it like it\'s hot! 🔥',
        'content' => 'This block example block gives you a glimpse of what you could do with this editor. I hope you enjoy using it!',
    ];

    public function __construct()
    {

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {

        return view('components.blocks.create-post');
    }
}
