<?php

/* Grupy */

Route::group(['prefix' => 'ogroup', 'middleware' => 'auth.laravel-crm'], function () {
    Route::get('', 'VentureDrake\LaravelCrm\Http\Controllers\OgroupController@index')
        ->name('laravel-crm.ogroup.index')
        ->middleware(['can:viewAny,VentureDrake\LaravelCrm\Models\Ogroup']);

    Route::any('search', 'VentureDrake\LaravelCrm\Http\Controllers\OgroupController@search')
        ->name('laravel-crm.ogroup.search')
        ->middleware(['can:viewAny,VentureDrake\LaravelCrm\Models\Ogroup']);

    Route::get('create', 'VentureDrake\LaravelCrm\Http\Controllers\OgroupController@create')
        ->name('laravel-crm.ogroup.create')
        ->middleware(['can:create,VentureDrake\LaravelCrm\Models\Ogroup']);

    Route::post('', 'VentureDrake\LaravelCrm\Http\Controllers\OgroupController@store')
        ->name('laravel-crm.ogroup.store')
        ->middleware(['can:create,VentureDrake\LaravelCrm\Models\Ogroup']);

    Route::get('{ogroup}', 'VentureDrake\LaravelCrm\Http\Controllers\OgroupController@show')
        ->name('laravel-crm.ogroup.show')
        ->middleware(['can:view,ogroup']);

    Route::get('{ogroup}/edit', 'VentureDrake\LaravelCrm\Http\Controllers\OgroupController@edit')
        ->name('laravel-crm.ogroup.edit')
        ->middleware(['can:update,ogroup']);

    Route::put('{ogroup}', 'VentureDrake\LaravelCrm\Http\Controllers\OgroupController@update')
        ->name('laravel-crm.ogroup.update')
        ->middleware(['can:update,ogroup']);

    Route::delete('{ogroup}', 'VentureDrake\LaravelCrm\Http\Controllers\OgroupController@destroy')
        ->name('laravel-crm.ogroup.destroy')
        ->middleware(['can:delete,ogroup']);

    Route::get('{ogroup}/autocomplete', 'VentureDrake\LaravelCrm\Http\Controllers\OgroupController@autocomplete')
        ->name('laravel-crm.ogroup.autocomplete')
        ->middleware(['can:viewAny,VentureDrake\LaravelCrm\Models\Ogroup']);
});
