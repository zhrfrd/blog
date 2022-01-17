<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;   //Post::factory()

    protected $guarded = [];
    protected $with = ['category', 'author'];   // Prevent N+1 problem

    public function scopeFilter($query, array $filters) {   // Post::newQuery()->filter()
        $query->when($filters['search'] ?? false, fn($query, $search) =>
            $query->where('title', 'like', '%' . 'search' . '%')   //SQL query: WHERE title like '%dummy text%'
                ->orWhere('body', 'like', '%' . 'search' . '%')
        );
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function author() {   //author_id
        return $this->belongsTo(User::class, 'user_id');
    }
}
