<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MenuItem extends Component
{
    public string $title;

    public string $route;

    public string $itemClass = '';

    public ?int $count;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $title, string $route, string $itemClass = '', int $count = null)
    {
        $this->title = $title;
        $this->route = $route;
        $this->itemClass = $itemClass;
        $this->count = $count;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.menu-item');
    }
}
