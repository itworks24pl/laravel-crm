<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

Route::group(['prefix' => 'recipes', 'middleware' => 'auth.laravel-crm'], function () {
    Route::any('filter', 'VentureDrake\LaravelCrm\Http\Controllers\PersonController@index')
        ->name('laravel-crm.recipes.filter')
        ->middleware(['can:viewAny,VentureDrake\LaravelCrm\Models\Person']);

    Route::any('search', 'VentureDrake\LaravelCrm\Http\Controllers\PersonController@search')
        ->name('laravel-crm.recipes.search')
        ->middleware(['can:viewAny,VentureDrake\LaravelCrm\Models\Person']);

    Route::get('', 'VentureDrake\LaravelCrm\Http\Controllers\RecipeController@index')
        ->name('laravel-crm.recipes.index');
        //->middleware(['can:viewAny,VentureDrake\LaravelCrm\Models\Recipe']);

    Route::get('create/{model?}/{id?}', 'VentureDrake\LaravelCrm\Http\Controllers\PersonController@create')
        ->name('laravel-crm.recipes.create')
        ->middleware(['can:create,VentureDrake\LaravelCrm\Models\Person']);

    Route::post('', 'VentureDrake\LaravelCrm\Http\Controllers\RecipeController@store')
        ->name('laravel-crm.recipes.store')
        ->middleware(['can:create,VentureDrake\LaravelCrm\Models\Recipe']);

    Route::get('{recipe}', 'VentureDrake\LaravelCrm\Http\Controllers\RecipeController@show')
        ->name('laravel-crm.recipes.show')
        ->middleware(['can:view,recipe']);

    Route::get('{recipe}/edit', 'VentureDrake\LaravelCrm\Http\Controllers\RecipeController@edit')
        ->name('laravel-crm.recipes.edit')
        ->middleware(['can:update,recipe']);

    Route::put('{recipe}', 'VentureDrake\LaravelCrm\Http\Controllers\PersonController@update')
        ->name('laravel-crm.recipes.update')
        ->middleware(['can:update,recipe']);

    Route::delete('{recipe}', 'VentureDrake\LaravelCrm\Http\Controllers\PersonController@destroy')
        ->name('laravel-crm.recipes.destroy')
        ->middleware(['can:delete,person']);

    Route::get('{recipe}/autocomplete', 'VentureDrake\LaravelCrm\Http\Controllers\PersonController@autocomplete')
        ->name('laravel-crm.recipes.autocomplete')
        ->middleware(['can:viewAny,VentureDrake\LaravelCrm\Models\Person']);
});
