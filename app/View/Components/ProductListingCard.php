<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class ProductListingCard extends Component
{
    public $frontCoverPath;
    public $title;
    public $authors;
    public $price;
    public $detailsUrl;

    /**
     * Create a new component instance.
     */
    public function __construct($frontCoverPath, $title, $authors, $price, $detailsUrl)
    {
        $this->frontCoverPath = $frontCoverPath;
        $this->title = $title;
        $this->authors = $authors;
        $this->price = $price;
        $this->detailsUrl = $detailsUrl;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.product-listing-card');
    }
}
