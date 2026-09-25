<?php
/*

namespace App\Models;

// use App\Enums\PostBlockType;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'post_id',
    'type',
    'position',
    'data',
])]
class PostBlock extends Model
{
    use HasUuids;

    protected function casts(): array
    {
        return [
            'type' => PostBlockType::class,
            'data' => 'array',
        ];
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function media()
    {
        return $this->belongsToMany(
            Media::class,
            'post_block_media'
        );
    }
} -->
*/



namespace App\Models;

use App\Enums\PostBlockType;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'post_id',
    'type',
    'position',
    'data',
])]
class PostBlock extends Model
{
    use HasUuids;

    protected function casts(): array
    {
        return [
            'type' => PostBlockType::class,
            'data' => 'array',
        ];
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
