<?php

use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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
    //  TEST N+1 problem
    DB::listen(function ($query) {
        logger($query->sql);
    });

    return view('posts', [
        // 'posts' => Post::all()     //<------ N+1 PROBLEM.
        'posts' => Post::latest()->get(),
        'categories' => Category::all()
    ]); 
})->name('home');


Route::get('posts/{post:slug}', function (Post $post) {   //Find post by slug
    //Find a post by its slug and pass it to a view called "post"
    return view('post', [
        'post' => $post
    ]);
});

Route::get('categories/{category:slug}', function (Category $category) {
    return view('posts', [   //Use 'posts' view to show posts in category
        'posts' => $category->posts,   //->load(['category', 'author']) to avoid N+1 problem
        'currentCategory' => $category,
        'categories' => Category::all()
    ]);
})->name('category');

Route::get('authors/{author:username}', function (User $author) {
    return view('posts', [   //Use 'posts' view to show posts in category
        'posts' => $author->posts,   //->load(['category', 'author']) to avoid N+1 problem
        'categories' => Category::all()
    ]);
});