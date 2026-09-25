<?php

namespace App\Models;

use App\Enums\MediaType;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'admin_id',
    'type',
    'original_filename',
    'url',
    'mime_type',
    'size',
])]
class Media extends Model
{
    use HasUuids;

    protected function casts(): array
    {
        return [
            'type' => MediaType::class,
            'size' => 'integer',
        ];
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function thumbnailPosts()
    {
        return $this->hasMany(Post::class, 'thumbnail_media_id');
    }

    public function thumbnailBooks()
    {
        return $this->hasMany(Book::class, 'thumbnail_media_id');
    }

    public function pdfBooks()
    {
        return $this->hasMany(Book::class, 'pdf_media_id');
    }
}
