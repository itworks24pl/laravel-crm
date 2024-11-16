<?php

/* Roles */
Route::group(['prefix' => 'roles', 'middleware' => 'auth.laravel-crm'], function () {
    Route::get('', 'VentureDrake\LaravelCrm\Http\Controllers\RoleController@index')
        ->name('laravel-crm.roles.index')
        ->middleware(['can:viewAny,VentureDrake\LaravelCrm\Models\Role']);

    Route::get('create', 'VentureDrake\LaravelCrm\Http\Controllers\RoleController@create')
        ->name('laravel-crm.roles.create')
        ->middleware(['can:create,VentureDrake\LaravelCrm\Models\Role']);

    Route::post('', 'VentureDrake\LaravelCrm\Http\Controllers\RoleController@store')
        ->name('laravel-crm.roles.store')
        ->middleware(['can:create,VentureDrake\LaravelCrm\Models\Role']);

    Route::get('{role}', 'VentureDrake\LaravelCrm\Http\Controllers\RoleController@show')
        ->name('laravel-crm.roles.show')
        ->middleware(['can:view,role']);

    Route::get('{role}/edit', 'VentureDrake\LaravelCrm\Http\Controllers\RoleController@edit')
        ->name('laravel-crm.roles.edit')
        ->middleware(['can:update,role']);

    Route::put('{role}', 'VentureDrake\LaravelCrm\Http\Controllers\RoleController@update')
        ->name('laravel-crm.roles.update')
        ->middleware(['can:update,role']);

    Route::delete('{role}', 'VentureDrake\LaravelCrm\Http\Controllers\RoleController@destroy')
        ->name('laravel-crm.roles.destroy')
        ->middleware(['can:delete,role']);
});
