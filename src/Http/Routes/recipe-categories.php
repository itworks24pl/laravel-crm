<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

/* Product Categories */

Route::group(['prefix' => 'recipe-categories', 'middleware' => 'auth.laravel-crm'], function () {
    Route::get('', 'VentureDrake\LaravelCrm\Http\Controllers\RecipeCategoryController@index')
        ->name('laravel-crm.recipe-categories.index')
        ->middleware(['can:viewAny,VentureDrake\LaravelCrm\Models\RecipeCategory']);

    Route::get('create', 'VentureDrake\LaravelCrm\Http\Controllers\RecipeCategoryController@create')
        ->name('laravel-crm.recipe-categories.create')
        ->middleware(['can:create,VentureDrake\LaravelCrm\Models\RecipeCategory']);

    Route::post('', 'VentureDrake\LaravelCrm\Http\Controllers\RecipeCategoryController@store')
        ->name('laravel-crm.recipe-categories.store')
        ->middleware(['can:create,VentureDrake\LaravelCrm\Models\RecipeCategory']);

    Route::get('{recipeCategory}', 'VentureDrake\LaravelCrm\Http\Controllers\ProductCategoryController@show')
        ->name('laravel-crm.recipe-categories.show')
        ->middleware(['can:view,recipeCategory']);

    Route::get('{recipeCategory}/edit', 'VentureDrake\LaravelCrm\Http\Controllers\ProductCategoryController@edit')
        ->name('laravel-crm.recipe-categories.edit')
        ->middleware(['can:update,recipeCategory']);

    Route::put('{recipeCategory}', 'VentureDrake\LaravelCrm\Http\Controllers\ProductCategoryController@update')
        ->name('laravel-crm.recipe-categories.update')
        ->middleware(['can:update,recipeCategory']);

    Route::delete('{recipeCategory}', 'VentureDrake\LaravelCrm\Http\Controllers\ProductCategoryController@destroy')
        ->name('laravel-crm.recipe-categories.destroy')
        ->middleware(['can:delete,recipeCategory']);
});