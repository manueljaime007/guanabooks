<?php

namespace App\Models;

use App\Enums\ContentStatus;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

#[Fillable([
    'admin_id',
    'post_category_id',
    'title',
    'slug',
    'resume',
    'thumbnail_media_id',
    'reading_time',
    'views',
    'shares',
    'status',
    'is_highlight',
    'published_at',
])]
class Post extends Model
{
    use HasUuids, SoftDeletes;

    protected $keyType = 'string';

    public $incrementing = false;

    protected function casts(): array
    {
        return [
            'status' => ContentStatus::class,
            'is_highlight' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function category()
    {
        return $this->belongsTo(PostCategory::class, 'post_category_id');
    }

    public function thumbnail()
    {
        return $this->belongsTo(Media::class, 'thumbnail_media_id');
    }

    public function blocks()
    {
        return $this->hasMany(PostBlock::class)
            ->orderBy('position');
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
        return $query->where('post_category_id', $categoryId);
    }

    public function likedByUser(string $userId): bool
    {
        return $this->likes()
            ->where('user_id', $userId)
            ->exists();
    }

    public function likesCount(): int
    {
        return $this->likes()->count();
    }

    public function incrementViews(): void
    {
        $this->increment('views');
    }

    public function incrementShares(): void
    {
        $this->increment('shares');
    }

    protected static function booted(): void
    {
        static::creating(function (Post $post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
        });
    }
}
