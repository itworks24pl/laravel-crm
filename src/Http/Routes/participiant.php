<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

Route::group(['prefix' => 'participiants', 'middleware' => 'auth.laravel-crm'], function () {
    Route::any('filter', 'VentureDrake\LaravelCrm\Http\Controllers\ParticipiantController@index')
        ->name('laravel-crm.participiants.filter')
        ->middleware(['can:viewAny,VentureDrake\LaravelCrm\Models\Person']);

    Route::any('search', 'VentureDrake\LaravelCrm\Http\Controllers\PersonController@search')
        ->name('laravel-crm.participiants.search')
        ->middleware(['can:viewAny,VentureDrake\LaravelCrm\Models\Person']);

    Route::get('', 'VentureDrake\LaravelCrm\Http\Controllers\ParticipiantController@index')
        ->name('laravel-crm.participiants.index')
        ->middleware(['can:viewAny,VentureDrake\LaravelCrm\Models\Participiant']);

    Route::get('create/{model?}/{id?}', 'VentureDrake\LaravelCrm\Http\Controllers\PersonController@create')
        ->name('laravel-crm.participiants.create')
        ->middleware(['can:create,VentureDrake\LaravelCrm\Models\Person']);

    Route::post('', 'VentureDrake\LaravelCrm\Http\Controllers\PersonController@store')
        ->name('laravel-crm.participiants.store')
        ->middleware(['can:create,VentureDrake\LaravelCrm\Models\Person']);

    Route::get('{person}', 'VentureDrake\LaravelCrm\Http\Controllers\PersonController@show')
        ->name('laravel-crm.participiants.show')
        ->middleware(['can:view,person']);

    Route::get('{person}/edit', 'VentureDrake\LaravelCrm\Http\Controllers\PersonController@edit')
        ->name('laravel-crm.participiants.edit')
        ->middleware(['can:update,person']);

    Route::put('{person}', 'VentureDrake\LaravelCrm\Http\Controllers\PersonController@update')
        ->name('laravel-crm.participiants.update')
        ->middleware(['can:update,person']);

    Route::delete('{person}', 'VentureDrake\LaravelCrm\Http\Controllers\PersonController@destroy')
        ->name('laravel-crm.participiants.destroy')
        ->middleware(['can:delete,person']);

    Route::get('{person}/autocomplete', 'VentureDrake\LaravelCrm\Http\Controllers\PersonController@autocomplete')
        ->name('laravel-crm.participiants.autocomplete')
        ->middleware(['can:viewAny,VentureDrake\LaravelCrm\Models\Person']);
});
