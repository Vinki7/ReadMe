<?php

namespace App\Http\Controllers;

use App\Enums\Category;
use App\Http\Controllers\Controller;
use App\Services\ProductService;
use Illuminate\Http\Request;

/**
 * Class HomeController
 * @package App\Http\Controllers
 * @description This controller handles the home page and product-related actions.
 */
class HomeController extends Controller
{
    protected ProductService $productService;

    /**
     * HomeController constructor.
     * @param ProductService $productService
     * @description This constructor initializes the ProductService instance.
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fantasyBooks = $this->productService->getLimitedProductsByCategory(Category::Fantasy, 3);
        $educationBooks = $this->productService->getLimitedProductsByCategory(Category::Education, 3);

        return view('home.index', compact('fantasyBooks', 'educationBooks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
