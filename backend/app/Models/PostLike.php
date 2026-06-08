<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['user_id', 'post_id'])]
class PostLike extends Model
{
    public $timestamps = false;
    protected $casts = [
        'created_at' => 'datetime'
    ];
}
