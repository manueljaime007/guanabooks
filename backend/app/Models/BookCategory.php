<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'name',
    'slug',
    'description'
])]
class BookCategory extends Model
{
    use HasUlids;

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function scopeWithBookCount($query)
    {
        return $query->withCount('books');
    }
}
