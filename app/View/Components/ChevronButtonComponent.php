<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class ChevronButtonComponent extends Component
{
    public string $direction;
    public string $classes;
    public string $onClick;

    /**
     * Create a new component instance.
     */
    public function __construct(string $direction, string $class = "", string $onClick)
    {
        $this->direction = $direction;
        $this->classes = trim("chevron-btn chevron-{$direction} {$class}");
        $this->onClick = $onClick;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.chevron-button-component')
            ->with('direction', $this->direction)
            ->with('classes', $this->classes)
            ->with('onclick', $this->onClick);
    }
}
