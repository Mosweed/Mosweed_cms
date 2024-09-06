<?php

namespace App\Livewire\Admin\DropBlockEditor;

use App\Classes\BlockClass;
use App\Models\pages;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;
use ReflectionClass;
use SplFileInfo;

class DropBlockEditor extends Component
{
    // public $hash;
    // public $history = [];
    // public int $historyIndex = -1;

    public $title;

    public $slug;

    public $status;

    public $page;

    public $selctedTab = 'blocks';

    public $activeBlockIndex = false;

    public $SelectedactiveBlock = false;

    public $blocks = null;

    public $loading = false;

    public $activeBlocks = [];

    public $rendercount = -1;

    protected $listeners = [
        'reoderactiveblocks' => 'reoderactiveblocks',
        'insertBlock' => 'insertBlock',
        'blockEditComponentUpdated' => 'blockUpdated',
        'blockEditComponentSelected' => 'blockSelected',

        'url_updated' => 'url_updated',

    ];

    public function save()
    {
        // dd($this->activeBlocks);

        $this->selctedTab = 'settings';

        if ($this->page) {

            $this->validate([
                'title' => ['required', 'min:3', Rule::unique(pages::class)->ignore($this->page->id)],
                'slug' => ['required', 'min:3', Rule::unique(pages::class)->ignore($this->page->id)],
                'status' => 'required| in:published,draft',
            ]);

            $this->page->update([
                'title' => $this->title,
                'slug' => $this->slug,
                'status' => $this->status,
                'content' => json_encode($this->activeBlocks),
            ]);
        } else {
            $this->validate([
                'title' => 'required | min:3 | unique:pages,title',
                'slug' => 'required | min:3 | unique:pages,slug',
                'status' => 'required| in:published,draft',
            ]);

            $this->page = pages::create([
                'title' => $this->title,
                'slug' => $this->slug,
                'status' => $this->status,
                'content' => json_encode($this->activeBlocks),
            ]);

        }

        $this->dispatch('swal_save');

        //  dd( $this->page);
        // $activeBlocks = collect($this->properties['activeBlocks'])
        // ->toJson();
        //  $this->dispatch('savepage', $activeBlocks);
    }

    public function url_updated()
    {
        return redirect()->route('admin.pages.update', $this->page->slug);
    }

    public function updatedTitle($value)
    {
        $this->slug = \Str::slug($value);
    }

    public function changeTab($tab)
    {
        $this->selctedTab = $tab;

        if ($tab == 'blocks') {
            $this->activeBlockIndex = false;
            $this->SelectedactiveBlock = false;
        }
    }

    // public function canUndo(): bool
    // {
    //     return $this->historyIndex > 0;
    // }

    // public function canRedo(): bool
    // {
    //     return $this->historyIndex < count($this->history) - 1;
    // }

    // public function undo(): void
    // {
    //     if (! $this->canUndo()) {
    //         return;
    //     }

    //     $this->historyIndex--;

    //     $this->activeBlocks = $this->history[$this->historyIndex]['activeBlocks'];
    //     $this->activeBlockIndex = $this->history[$this->historyIndex]['activeBlockIndex'];
    //     $this->updateHash();
    // }

    // public function updateHash(): void
    // {
    //     $this->hash = Str::random(10);
    // }

    // public function redo(): void
    // {
    //     if (! $this->canRedo()) {
    //         return;
    //     }

    //     $this->historyIndex++;

    //     $this->activeBlocks = $this->history[$this->historyIndex]['activeBlocks'];
    //     $this->activeBlockIndex = $this->history[$this->historyIndex]['activeBlockIndex'];
    //     $this->updateHash();
    // }

    // public function recordInHistory(): void
    // {

    //     $history = collect($this->history)
    //         ->slice(0, $this->historyIndex + 1)
    //         ->push([
    //             'activeBlocks' => $this->activeBlocks,
    //             'activeBlockIndex' => $this->activeBlockIndex,
    //         ])
    //         ->take(-5)
    //         ->values();

    //     $this->history = $history->toArray();

    //     $this->historyIndex = count($this->history) - 1;
    // }

    public function blockUpdated($position, $field, $value)
    {
        $this->activeBlocks[$position]['data'][$field] = $value;
    }

    public function blockSelected($blockId): void
    {

        $this->activeBlockIndex = $blockId;
        $this->SelectedactiveBlock = $this->activeBlocks[$blockId];
        $this->selctedTab = 'blocks';

    }

    public function deleteBlock(): void
    {
        $activeBlockId = $this->activeBlockIndex;

        $this->SelectedactiveBlock = false;
        $this->activeBlockIndex = false;
        $this->selctedTab = 'blocks';

        unset($this->activeBlocks[$activeBlockId]);

        $neworder = [];
        foreach ($this->activeBlocks as $key => $block) {
            $neworder[$key] = $block;
        }
        $this->activeBlocks = $neworder;

        //  $this->recordInHistory();
    }

    public function getBlockFromClassName($name): BlockClass
    {
        return BlockClass::fromName($name);
    }

    public function insertBlock($id, $index = null, $placement = null): void
    {

        // Retrieve the block from blocks array.
        $block = $this->blocks[$id];

        $block['id'] = (string) Str::uuid();

        // If index is -1, append the block to the end of activeBlocks.
        if ($index === -1) {
            $this->activeBlocks[] = $block;

            return;
        }

        // Determine the new index for insertion based on the placement directive.
        if ($placement === 'before') {
            $newIndex = max($index - 1, 0); // Ensure the new index is not negative.
        } else { // If 'after' or any other value including null, treat as 'after'.
            $newIndex = $index + 1;
        }

        // Insert the block into the activeBlocks array at the calculated new index.
        // Check if the new index is within the bounds of the current activeBlocks array.
        if ($newIndex >= count($this->activeBlocks)) {
            $this->activeBlocks[] = $block; // Append to the end if out of bounds.
        } else {
            $this->activeBlocks = array_merge(
                array_slice($this->activeBlocks, 0, $newIndex), // Elements before the new index
                [$block], // The block to insert
                array_slice($this->activeBlocks, $newIndex) // Elements after the new index
            );
        }

        // $this->recordInHistory();
    }

    public function reoderactiveblocks($orders)
    {

        $neworder = [];

        foreach ($orders as $order) {

            $neworder[] = $this->activeBlocks[$order['oldindex']];
        }
        $this->activeBlocks = $neworder;
        //  $this->recordInHistory();
    }

    public $shazzoo_components = [];

    protected function registerComponentsFromDirectory($baseClass, $register, $directory, $namespace)
    {

        if (blank($directory) || blank($namespace)) {
            return;
        }

        $filesystem = app(Filesystem::class);

        if ((! $filesystem->exists($directory)) && (! Str::of($directory)->contains(''))) {
            return;
        }

        $namespace = Str::of($namespace);
        $register = array_merge(
            $register,
            collect($filesystem->allFiles($directory))
                ->map(function (SplFileInfo $file) use ($namespace): string {
                    $variableNamespace = $namespace->contains('') ? str_ireplace(
                        [$namespace->beforeLast('\\'), $namespace->afterLast('\\')],
                        ['', ''],
                        Str::of($file->getPath())
                            ->after(base_path())
                            ->replace(['/', '\\'])
                    ) : null;
                    if (is_string($variableNamespace)) {
                        $variableNamespace = (string) Str::of($variableNamespace)->before('\\');
                    }

                    return (string) $namespace
                        ->append('\\', $file->getRelativePathname())
                        ->replace('*', $variableNamespace)
                        ->replace(['/', '.php'], ['\\', '']);
                })
                ->filter(fn (string $class): bool => is_subclass_of($class, $baseClass) && (! (new ReflectionClass($class))->isAbstract()))
                ->all(),
        );

        $test = [];
        foreach ($register as $class) {
            // Instantiate the class
            $instance = app($class);

            // Call the desired function on the class instance
            $test[] = $instance->toArray();

        }

        return $test;
    }

    public function mount()
    {

        $this->slug = \Str::slug($this->title);

        $this->blocks = $this->registerComponentsFromDirectory(
            BlockClass::class,
            $this->shazzoo_components,
            app_path('View/Components/Blocks'),
            'App\View\Components\Blocks',
        );

        if ($this->page) {
            $this->title = $this->page->title;
            $this->slug = $this->page->slug;
            $this->status = $this->page->status;
            $this->activeBlocks = json_decode($this->page->content, true);
        }

    }

    public function getActiveBlock(): bool|BlockClass
    {
        if (isset($this->activeBlockIndex) && $this->activeBlockIndex === false) {
            return false;
        }

        return BlockClass::fromName($this->activeBlocks[$this->activeBlockIndex]['class'])
            ->setdata($this->activeBlocks[$this->activeBlockIndex]['data'])->setid($this->activeBlocks[$this->activeBlockIndex]['id']);
    }

    public function render()
    {

        return view('livewire.admin.dropblockeditor.drop-block-editor', [
            'activeBlock' => $this->getActiveBlock(),
        ]);
    }
}
