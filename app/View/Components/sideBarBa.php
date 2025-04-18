<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class sideBarBa extends Component
{
    /**
     * Create a new component instance.
     */

    public $dosen;
    public $dosens;

    public function __construct($dosen = null, $dosens = null)
    {
        $this->dosens = $dosens;
        $this->dosen = $dosen;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.side-bar-ba');
    }
}
