<?php

namespace VentureDrake\LaravelCrm\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use VentureDrake\LaravelCrm\Http\Requests\StoreProductRequest;
use VentureDrake\LaravelCrm\Http\Requests\UpdateProductRequest;
use VentureDrake\LaravelCrm\Models\Product;
use VentureDrake\LaravelCrm\Services\ProductService;

class ProductController extends Controller
{
    /**
     * @var ProductService
     */
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Product::all()->count() < 30) {
            $products = Product::latest()->get();
        } else {
            $products = Product::latest()->paginate(30);
        }
        
        return view('laravel-crm::products.index', [
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('laravel-crm::products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $product = $this->productService->create($request);
        
        flash('Product stored')->success()->important();

        return redirect(route('laravel-crm.products.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('laravel-crm::products.show', [
            'product' => $product,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('laravel-crm::products.edit', [
            'product' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product = $this->productService->update($product, $request);
        
        flash('Product updated')->success()->important();

        return redirect(route('laravel-crm.products.show', $product));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        flash('Product deleted')->success()->important();

        return redirect(route('laravel-crm.products.index'));
    }

    public function search(Request $request)
    {
        $searchValue = $request->search;

        $products = Product::all()->filter(function ($record) use ($searchValue) {
            foreach ($record->getSearchable() as $field) {
                if (Str::contains($record->{$field}, $searchValue)) {
                    return $record;
                }
            }
        });

        return view('laravel-crm::products.index', [
            'products' => $products,
        ]);
    }
}
