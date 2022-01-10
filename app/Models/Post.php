<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;

class Post {
    public static function all() {
        $files = File::files(resource_path("posts/"));

        return array_map(fn($file) => $file->getContents(), $files);
    }

    //Find post by its slug
    public static function find($slug) {
        base_path();

        if (! file_exists($path = resource_path("posts/{$slug}.html")))
            throw new ModelNotFoundException();

        //Enable caching of post
        return cache()->remember("posts.{$slug}", 1200, fn() => file_get_contents($path));
    }
}