<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

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
    return view('posts', [
        'posts' => Post::all()
    ]); 
});


Route::get('posts/{post:slug}', function (Post $post) {   //Find post by slug
    //Find a post by its slug and pass it to a view called "post"
    return view('post', [
        'post' => $post
    ]);
});