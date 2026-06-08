<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


#[Fillable([
    'user_id',
    'book_category_id',
    'title',
    'slug',
    'resume',
    'thumbnail_url',
    'pdf_url',
    'reading_time',
    'status',
    'is_highlight',
    'published_at'
])]
class Book extends Model
{
    use HasUlids, SoftDeletes;

    protected $casts = [
        'published_at' => 'datetime',
        'is_highlight' => 'boolean'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(BookCategory::class, 'book_category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'book_tag');
    }

    public function favorites()
    {
        return $this->hasMany(BookFavorite::class);
    }

    // Scopes
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
        return $query->where('book_category_id', $categoryId);
    }

    // Métodos auxiliares
    public function isFavoriteByUser(String $userId)
    {
        return $this->favorites()->where('user_id', $userId)->exists();
    }

    public function incrementDownloads()
    {
        $this->increment('downloads');
    }

    public function incrementShares()
    {
        $this->increment('shares');
    }
}
