<?php

namespace App\Models;

use App\Enums\ContentStatus;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable([
    'admin_id',
    'book_category_id',
    'title',
    'slug',
    'resume',
    'thumbnail_media_id',
    'pdf_media_id',
    'reading_time',
    'downloads',
    'shares',
    'status',
    'is_highlight',
    'published_at',
])]
class Book extends Model
{
    use HasUuids, SoftDeletes;

    protected $keyType = 'string';

    public $incrementing = false;

    protected function casts(): array
    {
        return [
            'status' => ContentStatus::class,
            'published_at' => 'datetime',
            'is_highlight' => 'boolean',
        ];
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function category()
    {
        return $this->belongsTo(BookCategory::class, 'book_category_id');
    }

    public function thumbnail()
    {
        return $this->belongsTo(Media::class, 'thumbnail_media_id');
    }

    public function pdf()
    {
        return $this->belongsTo(Media::class, 'pdf_media_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'book_tag');
    }

    public function favorites()
    {
        return $this->hasMany(BookFavorite::class);
    }

    public function scopePublished($query)
    {
        return $query
            ->where('status', ContentStatus::PUBLISHED)
            ->whereNotNull('published_at');
    }

    public function scopeHighlighted($query)
    {
        return $query->where('is_highlight', true);
    }

    public function scopeByCategory($query, string $categoryId)
    {
        return $query->where('book_category_id', $categoryId);
    }

    public function isFavoriteByUser(string $userId): bool
    {
        return $this->favorites()
            ->where('user_id', $userId)
            ->exists();
    }

    public function incrementDownloads(): void
    {
        $this->increment('downloads');
    }

    public function incrementShares(): void
    {
        $this->increment('shares');
    }
}
