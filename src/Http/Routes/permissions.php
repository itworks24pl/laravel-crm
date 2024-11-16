<?php

/* Permissions */
Route::group(['prefix'=>'permissions', 'middleware'=> 'auth.laravel-crm'], function (){
    Route::get('', 'VentureDrake\LaravelCrm\Http\Controllers\PermissionController@index')
    ->name('laravel-crm.permissions.index')
    ->middleware(['can:viewAny,VentureDrake\LaravelCrm\Models\Role']);

    Route::get('create', 'VentureDrake\LaravelCrm\Http\Controllers\PermissionController@create')
    ->name('laravel-crm.permissions.create')
    ->middleware(['can:viewAny,VentureDrake\LaravelCrm\Models\Role']);

    Route::post('', 'VentureDrake\LaravelCrm\Http\Controllers\PermissionController@store')
    ->name('laravel-crm.permissions.store')
    ->middleware(['can:create,VentureDrake\LaravelCrm\Models\Role']);

    Route::get('{permission}', 'VentureDrake\LaravelCrm\Http\Controllers\PermissionController@show')
    ->name('laravel-crm.permissions.show')
    ->middleware(['can:viewAny,VentureDrake\LaravelCrm\Models\Role']);

    Route::get('{permission}/edit', 'VentureDrake\LaravelCrm\Http\Controllers\PermissionController@edit')
    ->name('laravel-crm.permissions.edit')
    ->middleware(['can:viewAny,VentureDrake\LaravelCrm\Models\Role']);

    Route::put('{permission}', 'VentureDrake\LaravelCrm\Http\Controllers\PermissionController@update')
    ->name('laravel-crm.permissions.update');
    //->middleware(['can:update,role']);

    Route::delete('{permission}', 'VentureDrake\LaravelCrm\Http\Controllers\PermissionController@destroy')
    ->name('laravel-crm.permissions.destroy')
    ->middleware(['can:delete,role']);
});
