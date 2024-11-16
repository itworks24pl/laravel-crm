<?php

namespace VentureDrake\LaravelCrm\Http\Controllers;

use Ramsey\Uuid\Uuid;
use VentureDrake\LaravelCrm\Http\Requests\StoreProductCategoryRequest;
use VentureDrake\LaravelCrm\Http\Requests\UpdateProductCategoryRequest;
use VentureDrake\LaravelCrm\Models\RecipeCategory;

class RecipeCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (RecipeCategory::all()->count() < 30) {
            $recipeCategories = RecipeCategory::latest()->get();
        } else {
            $recipeCategories = RecipeCategory::latest()->paginate(30);
        }

        return view('laravel-crm::recipe-categories.index', [
            'recipeCategories' => $recipeCategories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('laravel-crm::recipe-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductCategoryRequest $request)
    {
        RecipeCategory::create([
            'external_id' => Uuid::uuid4()->toString(),
            'name' => $request->name,
            'description' => $request->description,
        ]);

        flash(ucfirst(trans('laravel-crm::lang.recipe_category_stored')))->success()->important();

        return redirect(route('laravel-crm.recipe-categories.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(RecipeCategory $recipeCategory)
    {
        return view('laravel-crm::recipe-categories.show', [
            'recipeCategory' => $recipeCategory,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(RecipeCategory $recipeCategory)
    {
        return view('laravel-crm::recipe-categories.edit', [
            'recipeCategory' => $recipeCategory,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductCategoryRequest $request, ProductCategory $productCategory)
    {
        $productCategory->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        flash(ucfirst(trans('laravel-crm::lang.product_category_updated')))->success()->important();

        return redirect(route('laravel-crm.product-categories.show', $productCategory));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCategory $productCategory)
    {
        $productCategory->delete();

        flash(ucfirst(trans('laravel-crm::lang.product_category_deleted')))->success()->important();

        return redirect(route('laravel-crm.product-categories.index'));
    }
}
