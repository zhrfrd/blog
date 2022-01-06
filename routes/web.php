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

//When the homepage is loaded (/) call the view (resources > views) welcome.blade.php
Route::get('/', function () {
    return view('posts'); 
});


Route::get('/post', function () {
    return view('post');
});