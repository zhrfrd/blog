<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{  
    public function index() {
        return view('posts.index', [   //'posts.index' is just a convention. Not necessary
            'posts' => Post::latest()->filter(request(['search', 'category']))->get(),
        ]);
    }

    public function show(Post $post) {
        //Find a post by its slug and pass it to a view called "post"
        return view('post.show', [   //'posts.show' is just a convention. Not necessary
            'post' => $post
        ]);
    }
}
