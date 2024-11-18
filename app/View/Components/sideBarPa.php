<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class sideBarPa extends Component
{
    /**
     * Create a new component instance.
     */

    public $dosens;
    public $dosen;

    public function __construct($dosens = null, $dosen = null)
    {
        $this->dosen = $dosen;
        $this->dosens = $dosens;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.side-bar-pa');
    }
}
