<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;   //Post::factory()

    protected $guarded = [];
    protected $with = ['category', 'author'];   // Prevent N+1 problem

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function author() {   //author_id
        return $this->belongsTo(User::class, 'user_id');
    }
}
