<?php

/* Grupy */

Route::group(['prefix' => 'product-return', 'middleware' => 'auth.laravel-crm'], function () {
    Route::get('', 'VentureDrake\LaravelCrm\Http\Controllers\ProductReturnController@index')
        ->name('laravel-crm.product-return.index');
        //->middleware(['can:viewAny,VentureDrake\LaravelCrm\Models\ProductReturn']);

    Route::any('search', 'VentureDrake\LaravelCrm\Http\Controllers\ProductReturnController@search')
        ->name('laravel-crm.product-return.search')
        ->middleware(['can:viewAny,VentureDrake\LaravelCrm\Models\ProductReturn']);

    Route::get('create', 'VentureDrake\LaravelCrm\Http\Controllers\ProductReturnController@create')
        ->name('laravel-crm.product-return.create')
        ->middleware(['can:create,VentureDrake\LaravelCrm\Models\ProductReturn']);

    Route::post('', 'VentureDrake\LaravelCrm\Http\Controllers\ProductReturnController@store')
        ->name('laravel-crm.product-return.store')
        ->middleware(['can:create,VentureDrake\LaravelCrm\Models\ProductReturn']);

    Route::get('{product-return}', 'VentureDrake\LaravelCrm\Http\Controllers\ProductReturnController@show')
        ->name('laravel-crm.product-return.show')
        ->middleware(['can:view,product-return']);

    Route::get('{product-return}/edit', 'VentureDrake\LaravelCrm\Http\Controllers\ProductReturnController@edit')
        ->name('laravel-crm.product-return.edit')
        ->middleware(['can:update,product-return']);

    Route::put('{product-return}', 'VentureDrake\LaravelCrm\Http\Controllers\ProductReturnController@update')
        ->name('laravel-crm.product-return.update')
        ->middleware(['can:update,product-return']);

    Route::delete('{product-return}', 'VentureDrake\LaravelCrm\Http\Controllers\ProductReturnController@destroy')
        ->name('laravel-crm.product-return.destroy')
        ->middleware(['can:delete,product-return']);

    Route::get('{product-return}/autocomplete', 'VentureDrake\LaravelCrm\Http\Controllers\ProductReturnController@autocomplete')
        ->name('laravel-crm.product-return.autocomplete')
        ->middleware(['can:viewAny,VentureDrake\LaravelCrm\Models\ProductReturn']);
});
