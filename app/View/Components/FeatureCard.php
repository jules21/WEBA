<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FeatureCard extends Component
{
    public string $title;

    public string $description;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $title = 'Title', string $description = 'Description')
    {
        $this->title = $title;
        $this->description = $description;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.feature-card');
    }
}
