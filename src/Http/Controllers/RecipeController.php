<?php

namespace VentureDrake\LaravelCrm\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use VentureDrake\LaravelCrm\Http\Requests\StoreRecipeRequest;
use VentureDrake\LaravelCrm\Http\Requests\UpdateRecipeRequest;
use VentureDrake\LaravelCrm\Models\Recipe;
use VentureDrake\LaravelCrm\Services\RecipeService;

class RecipeController extends Controller
{
    /**
     * @var RecipeService
     */
    private $recipeService;

    public function __construct(RecipeService $recipeService)
    {
        $this->recipeService = $recipeService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Recipe::resetSearchValue($request);
        $params = $request->except('_token');

        if (Recipe::filter($params)->get()->count() < 30) {
            $recipes = Recipe::filter($params)->latest()->get();
        } else {
            $recipes = Recipe::filter($params)->latest()->paginate(30);
        }

        return view('laravel-crm::recipes.index', [
            'recipes' => $recipes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('laravel-crm::recipes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRecipeRequest $request)
    {
        $recipe = $this->recipeService->create($request);

        flash(ucfirst(trans('laravel-crm::lang.recipe_stored')))->success()->important();

        return redirect(route('laravel-crm.recipes.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Recipe $recipe)
    {
        return view('laravel-crm::recipes.show', [
            'recipe' => $recipe,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Recipe $recipe)
    {
        return view('laravel-crm::recipes.edit', [
            'recipe' => $recipe,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRecipeRequest $request, Recipe $recipe)
    {
        $recipe = $this->recipeService->update($recipe, $request);

        flash(ucfirst(trans('laravel-crm::lang.recipe_updated')))->success()->important();

        return redirect(route('laravel-crm.recipes.show', $recipe));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recipe $recipe)
    {
        $recipe->delete();

        flash(ucfirst(trans('laravel-crm::lang.recipe_deleted')))->success()->important();

        return redirect(route('laravel-crm.recipes.index'));
    }

    public function search(Request $request)
    {
        $searchValue = Recipe::searchValue($request);

        if (! $searchValue || trim($searchValue) == '') {
            return redirect(route('laravel-crm.recipes.index'));
        }

        $recipes = Recipe::all()->filter(function ($record) use ($searchValue) {
            foreach ($record->getSearchable() as $field) {
                if (Str::contains(strtolower($record->{$field}), strtolower($searchValue))) {
                    return $record;
                }
            }
        });

        return view('laravel-crm::recipes.index', [
            'recipes' => $recipes,
            'searchValue' => $searchValue ?? null,
        ]);
    }

    public function autocomplete(Recipe $recipe)
    {
        $recipePrice = $recipe->getDefaultPrice();

        return response()->json([
            'price' => ($recipePrice->unit_price) ? $recipePrice->unit_price / 100 : null,
        ]);
    }
}
