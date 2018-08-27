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

    Route::get('/resources/{resource}/{key}', 'DetailController')
        ->name('resources.detail');

    Route::get('/resources/{resource}/{key}/edit', 'EditController')
        ->name('resources.edit');

    Route::put('/resources/{resource}/{key}', 'UpdateController')
        ->name('resources.update');

    Route::delete('/resources/{resource}/{key}', 'DeleteController')
        ->name('resources.delete');

    /**
     * HasOneController
     */
    Route::get('/relationships/{resource}/{resourceKey}/hasOne/{relationship}/create', 'HasOneController@create')
        ->name('relationships.hasOne.create');

    /**
     * BelongsToController
     */
    Route::get('/relationships/{resource}/belongsTo/{relationship}', 'BelongsToController@index')
        ->name('relationships.belongsTo');

    /**
     * HasManyController
     */
    Route::get('/relationships/{resource}/{resourceKey}/hasMany/{relationship}', 'HasManyController@index')
        ->name('relationships.hasMany');

    Route::get('/relationships/{resource}/{resourceKey}/hasMany/{relationship}/create', 'HasManyController@create')
        ->name('relationships.hasMany.create');

    /**
     * BelongsToManyController
     */
    Route::get('/relationships/{resource}/{key}/belongsToMany/{relationship}', 'BelongsToManyController@index')
        ->name('resources.belongsToMany');

    Route::get('/relationships/{resource}/{key}/belongsToMany/{relationship}/attach', 'BelongsToManyController@create')
        ->name('resources.belongsToMany.create');

    Route::post('/relationships/{resource}/{key}/belongsToMany/{relationship}/attach', 'BelongsToManyController@attach')
        ->name('resources.belongsToMany.attach');

    Route::get('/relationships/{resource}/{key}/belongsToMany/{relationship}/{what}/edit', 'BelongsToManyController@edit')
        ->name('resources.belongsToMany.edit');

    Route::put('/relationships/{resource}/{key}/belongsToMany/{relationship}/{what}', 'BelongsToManyController@update')
        ->name('resources.belongsToMany.update');

    Route::delete('/relationships/{resource}/{key}/belongsToMany/{relationship}/detach/{what}', 'BelongsToManyController@detach')
        ->name('resources.belongsToMany.detach');

});
