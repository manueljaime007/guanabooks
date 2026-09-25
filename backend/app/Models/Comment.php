<?php

namespace App\Models;

use App\Enums\CommentStatus;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable([
    'user_id',
    'post_id',
    'content',
    'status',
])]
class Comment extends Model
{
    use HasUuids, SoftDeletes;

    protected function casts(): array
    {
        return [
            'status' => CommentStatus::class,
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function scopeApproved($query)
    {
        return $query->where('status', CommentStatus::APPROVED);
    }

    public function scopePending($query)
    {
        return $query->where('status', CommentStatus::PENDING);
    }
}
