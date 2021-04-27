<?php

use Illuminate\Support\Facades\Route;

//prefixed with 'dashboard'
//configure in app/Providers/RouteServiceProvider.php

Route::middleware('auth')->group(function(){
    Route::get('/posts', 'PostController@index')->name('admin.post.index');
    Route::get('/posts/create', 'PostController@create')->name('admin.post.create');
    Route::post('/posts', 'PostController@store')->name('admin.post.store');
    Route::get('/posts/{post}/edit', 'PostController@edit')->name('admin.post.edit');
    Route::patch('/posts/{post}/update', 'PostController@update')->name('admin.post.update');
    Route::delete('/posts/{post}/destroy', 'PostController@destroy')->name('admin.post.destroy');
});
