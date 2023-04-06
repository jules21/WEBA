<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ExportForm extends Component
{
    public $action;

    public $exportLink;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($action, $exportLink)
    {
        $this->action = $action;
        $this->exportLink = $exportLink;
    }

    public function render()
    {
        return view('components.export-form');
    }
}
