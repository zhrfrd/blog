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


Route::get('posts/{post}', function ($slug) {
    //Find a post by its slug and pass it to a view called "post"

    if (! file_exists($path = __DIR__ . "/../resources/posts/{$slug}.html"))
        return redirect ("/");

    //Enable caching of post
    $post = cache()->remember("posts.{$slug}", 5, fn() => file_get_contents($path));

    return view('post', ['post' => $post]);
})->where('post', '[A-z_\-]+');