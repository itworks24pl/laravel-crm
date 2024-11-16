<?php

/* Settings */

Route::group(['prefix' => 'settings', 'middleware' => 'auth.laravel-crm'], function () {
    Route::get('', 'VentureDrake\LaravelCrm\Http\Controllers\SettingController@edit')
        ->name('laravel-crm.settings.edit')
        ->middleware(['can:update,VentureDrake\LaravelCrm\Models\Setting']);

    Route::post('', 'VentureDrake\LaravelCrm\Http\Controllers\SettingController@update')
        ->name('laravel-crm.settings.update')
        ->middleware(['can:update,VentureDrake\LaravelCrm\Models\Setting']);
});
