<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class ProductListingCard extends Component
{
    public $id;
    public $frontCoverPath;
    public $title;
    public $authors;
    public $price;
    public $productId;

    /**
     * Create a new component instance.
     */
    public function __construct($id, $frontCoverPath, $title, $authors, $price, $productId)
    {
        $this->id = $id;
        $this->frontCoverPath = $frontCoverPath;
        $this->title = $title;
        $this->authors = $authors;
        $this->price = $price;
        $this->productId = $productId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.product-listing-card');
    }
}
