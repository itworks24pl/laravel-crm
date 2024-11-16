<?php

/* Products */

Route::group(['prefix' => 'products', 'middleware' => 'auth.laravel-crm'], function () {
    Route::get('', 'VentureDrake\LaravelCrm\Http\Controllers\ProductController@index')
        ->name('laravel-crm.products.index')
        ->middleware(['can:viewAny,VentureDrake\LaravelCrm\Models\Product']);

    Route::any('search', 'VentureDrake\LaravelCrm\Http\Controllers\ProductController@search')
        ->name('laravel-crm.products.search')
        ->middleware(['can:viewAny,VentureDrake\LaravelCrm\Models\Product']);

    Route::get('create', 'VentureDrake\LaravelCrm\Http\Controllers\ProductController@create')
        ->name('laravel-crm.products.create')
        ->middleware(['can:create,VentureDrake\LaravelCrm\Models\Product']);

    Route::post('', 'VentureDrake\LaravelCrm\Http\Controllers\ProductController@store')
        ->name('laravel-crm.products.store')
        ->middleware(['can:create,VentureDrake\LaravelCrm\Models\Product']);

    Route::get('{product}', 'VentureDrake\LaravelCrm\Http\Controllers\ProductController@show')
        ->name('laravel-crm.products.show')
        ->middleware(['can:view,product']);

    Route::get('{product}/edit', 'VentureDrake\LaravelCrm\Http\Controllers\ProductController@edit')
        ->name('laravel-crm.products.edit')
        ->middleware(['can:update,product']);

    Route::put('{product}', 'VentureDrake\LaravelCrm\Http\Controllers\ProductController@update')
        ->name('laravel-crm.products.update')
        ->middleware(['can:update,product']);

    Route::delete('{product}', 'VentureDrake\LaravelCrm\Http\Controllers\ProductController@destroy')
        ->name('laravel-crm.products.destroy')
        ->middleware(['can:delete,product']);

    Route::get('{product}/autocomplete', 'VentureDrake\LaravelCrm\Http\Controllers\ProductController@autocomplete')
        ->name('laravel-crm.products.autocomplete')
        ->middleware(['can:viewAny,VentureDrake\LaravelCrm\Models\Product']);
});
