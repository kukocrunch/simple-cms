<?php

use Illuminate\Support\Facades\Route;

//prefixed with 'dashboard'
//configure in app/Providers/RouteServiceProvider.php

Route::middleware('auth')->group(function(){
    Route::put('/users/{user}/update', 'UserController@update')->name('user.profile.update');

    Route::middleware('role:admin')->group(function(){
        Route::get('/users', 'UserController@index')->name('users.index');
        Route::delete('/users/{user}/destroy', 'UserController@destroy')->name('user.destroy');
        Route::put('/users/{user}/attach', 'UserController@attachRole')->name('user.role.attach');
        Route::put('/users/{user}/detach', 'UserController@detachRole')->name('user.role.detach');
    });
    Route::middleware(['can:view,user'])->group(function(){
        Route::get('/users/{user}/profile', 'UserController@show')->name('user.profile.show');
    });
});

