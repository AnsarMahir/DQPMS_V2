<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModerateMCQ extends Component
{
    public $i;
    public $data;
    /**
     * Create a new component instance.
     */
    public function __construct($i,$data)
    {
        $this->i=$i;
        $this->data = $data;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.moderate-m-c-q');
    }
}
