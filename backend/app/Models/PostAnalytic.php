<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(
    [
        'post_id',
        'user_id',
        'ip_address',
        'user_agent',
        'viewed_at'
    ]
)]
class PostAnalytic extends Model
{
    protected $table = 'post_analytics';
    public $timestamps = false;

    protected $casts = [
        'viewed_at' => 'datetime'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
