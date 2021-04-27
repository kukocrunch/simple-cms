<?php

use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function(){
    Route::middleware('role:admin,manager')->group(function(){
        Route::get('/roles', 'RoleController@index')->name('roles.index');
        Route::post('/roles', 'RoleController@store')->name('roles.store');
        Route::delete('/roles/{role}/destroy', 'RoleController@destroy')->name('roles.destroy');
        Route::get('/roles/{role}/edit', 'RoleController@edit')->name('roles.edit');
        Route::put('/roles/{role}/update', 'RoleController@update')->name('roles.update');

        Route::put('/roles/{role}/attach', 'RoleController@attachPermission')->name('roles.permission.attach');
        Route::put('/roles/{role}/detach', 'RoleController@detachPermission')->name('roles.permission.detach');

    });
});