<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class sideBarDekan extends Component
{
    /**
     * Create a new component instance.
     */
    public $dekan;
    
    public function __construct($dekan)
    {
        $this->dekan = $dekan;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.side-bar-dekan');
    }
}
