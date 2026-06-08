<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable([
    'user_id',
    'post_category_id',
    'title',
    'slug',
    'resume',
    'content',
    'thumbnail_url',
    'reading_time',
    'status',
    'is_highlight',
    'published_at'
])]


class Post extends Model
{
    use HasUlids, SoftDeletes;

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(PostCategory::class, 'post_category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag');
    }

    public function likes()
    {
        return $this->hasMany(PostLike::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function analytics()
    {
        return $this->hasMany(PostAnalytic::class);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published')
            ->whereNotNull('published_at');
    }

    public function scopeHighlighted($query)
    {
        return $query->where('is_highlight', true);
    }

    public function scopeByCategory($query, String $categoryId)
    {
        return $query->where('post_category_id', $categoryId);
    }

    // Métodos auxiliares
    public function likedByUser(String $userId)
    {
        return $this->likes()->where('user_id', $userId)->exists();
    }

    public function incrementViews()
    {
        $this->increment('views');
    }

    public function incrementShares()
    {
        $this->increment('shares');
    }

    protected $casts = [
        'published_at' => 'datetime',
        'is_highlight' => 'boolean',
    ];
}
