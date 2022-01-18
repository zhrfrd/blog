<?php

use App\Http\Controllers\PostController;
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

Route::get('/', [PostController::class, 'index'])->name('home');

Route::get('posts/{post:slug}', [PostController::class, 'show']);   //Find post by slug
    
// Route::get('categories/{category:slug}', function (Category $category) {
//     return view('posts', [   //Use 'posts' view to show posts in category
//         'posts' => $category->posts,   //->load(['category', 'author']) to avoid N+1 problem
//         'currentCategory' => $category,
//         'categories' => Category::all()
//     ]);
// })->name('category');

Route::get('authors/{author:username}', function (User $author) {
    return view('posts', [   //Use 'posts' view to show posts in category
        'posts' => $author->posts,   //->load(['category', 'author']) to avoid N+1 problem
    ]);
});