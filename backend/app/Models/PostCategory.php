<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable([
    'name',
    'slug',
    'description',
    'icon_url'
])]
class PostCategory extends Model
{
    use HasUuids, SoftDeletes;

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function scopeWithBookCount($query)
    {
        return $query->withCount('books');
    }
}
