<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'slug'])]
class Tag extends Model
{
    use HasUuids;

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_tag');
    }

    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_tag');
    }
}
