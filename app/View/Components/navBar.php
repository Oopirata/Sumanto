<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class navBar extends Component
{
    /**
     * Create a new component instance.
     */
    
    public $user;
    public $dekan;
    public $mahasiswa;
    public $dosens;
    public function __construct($dosens = null, $mahasiswa = null, $dekan = null, $user = null)
    {
        $this->user = $user; 
        $this->dekan = $dekan;
        $this->mahasiswa = $mahasiswa;
        $this->dosens = $dosens;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.nav-bar');
    }
}
