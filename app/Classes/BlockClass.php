<?php

namespace App\Classes;

use Illuminate\Support\Str;
use Illuminate\View\Component;
use ReflectionClass;

class BlockClass extends Component
{
    public string $title;

    public string $icon = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M5.25 7.5A2.25 2.25 0 017.5 5.25h9a2.25 2.25 0 012.25 2.25v9a2.25 2.25 0 01-2.25 2.25h-9a2.25 2.25 0 01-2.25-2.25v-9z" /></svg>';

    public mixed $category = null;

    public array $data = [];

    public $position;

    public $id;

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function setdata($data)
    {
        $this->data = $data;

        return $this;
    }

    public function setid($id)
    {
        $this->id = $id;

        return $this;
    }

    public static function fromName($name, ...$args)
    {
        return new $name($args);
    }

    public function toArray(): array
    {
        $reflection = new ReflectionClass(get_class($this));

        $shortName = class_basename(get_class($this));

        $className = Str::kebab($shortName);

        return [
            'id' => $this->id ?? '',
            'data' => $this->data,
            'class' => get_class($this),
            'category' => $this->category,
            'name' => $className,
            'title' => $this->title,

        ];
    }

    public function render()
    {

    }
}
