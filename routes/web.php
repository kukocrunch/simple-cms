<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
// Route::get('/post', 'PostController@index')->name('post');
Route::get('/post/{post}', 'PostController@show')->name('post');


Route::middleware('auth')->group(function(){
    Route::get('/dashboard', 'AdminsController@index')->name('admin.index');

    Route::get('/dashboard/posts', 'PostController@index')->name('admin.post.index');
    Route::get('/dashboard/posts/create', 'PostController@create')->name('admin.post.create');
    Route::post('/dashboard/posts', 'PostController@store')->name('admin.post.store');
    Route::get('/dashboard/posts/{post}/edit', 'PostController@edit')->name('admin.post.edit');
    Route::patch('/dashboard/posts/{post}/update', 'PostController@update')->name('admin.post.update');
    Route::delete('/dashboard/posts/{post}/delete', 'PostController@destroy')->name('admin.post.destroy');
});