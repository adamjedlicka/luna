<?php

Route::group([
    'namespace' => 'AdamJedlicka\Admin\Http\Controllers',
    'middleware' => [
        \Illuminate\Cookie\Middleware\EncryptCookies::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\Auth\Middleware\Authenticate::class,
    ],
    'prefix' => config('admin.prefix') . '/api',
], function () {

    /**
     * AdminController
     */
    Route::get('/resources', 'AdminController@resources')
        ->name('admin.resources');

    /**
     * ResourceController
     */
    Route::get('/resources/{resource}', 'IndexController')
        ->name('resources.index');

    Route::get('/resources/{resource}/create', 'CreateController')
        ->name('resources.create');

    Route::post('/resources/{resource}', 'StoreController')
        ->name('resources.store');

    Route::get('/resources/{resource}/{resourceKey}', 'ShowController')
        ->name('resources.show');

    Route::get('/resources/{resource}/{resourceKey}/edit', 'EditController')
        ->name('resources.edit');

    Route::put('/resources/{resource}/{resourceKey}', 'UpdateController')
        ->name('resources.update');

    Route::delete('/resources/{resource}/{resourceKey}', 'DeleteController')
        ->name('resources.delete');

    /**
     * HasManyController
     */
    Route::get('/resources/{resource}/{resourceKey}/hasMany/{relationship}', 'HasManyController@index')
        ->name('resources.hasMany');

    /**
     * BelongsToManyController
     */
    Route::get('/resources/{resource}/{resourceKey}/belongsToMany/{relationship}', 'BelongsToManyController@index')
        ->name('resources.belongsToMany');

});
