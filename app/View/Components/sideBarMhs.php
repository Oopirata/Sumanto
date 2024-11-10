<?php

namespace App\View\Components;

use App\Models\Mahasiswa;
use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class sideBarMhs extends Component
{
    /**
     * Create a new component instance.
     */

    public $mahasiswa;

    public function __construct($mahasiswa)
    {
        $this->mahasiswa = $mahasiswa;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.side-bar-mhs');
    }
}
