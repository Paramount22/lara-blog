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

Auth::routes(['register' => false]);

Route::get('/', 'PostController@listPosts')->name('posts');
Route::get('/about', function () {
   return view('about');
});

Route::resource('/categories', 'CategoryController');
Route::resource('/tags', 'TagController');
Route::resource('/posts', 'PostController');


Route::get('/home', 'HomeController@index')->name('home');
