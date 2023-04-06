<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CounterCard extends Component
{
    public $title;

    public $count;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $title = 'Title',
        $count = 0
    ) {
        $this->title = $title;
        $this->count = $count;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.counter-card');
    }
}
