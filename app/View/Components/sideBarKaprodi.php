<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class sideBarKaprodi extends Component
{
    /**
     * Create a new component instance.
     */

    public $user;
    public $userr;

    public function __construct($user=null, $userr=null)
    {
        $this->user = $user;
        $this->userr = $userr;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.side-bar-kaprodi');
    }
}
