<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MenuItem extends Component
{

    public string $title;
    public string $route;
    public string $itemClass='';

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $title, string $route, string $itemClass='')
    {
        $this->title = $title;
        $this->route = $route;
        $this->itemClass = $itemClass;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('components.menu-item');
    }
}
