<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'resume' => $this->resume,
            'content' => $this->content,
            'thumbnail_url' => $this->thumbnail_url,
            'reading_time' => $this->reading_time,
            'views' => $this->views,
            'shares' => $this->shares,
            'status' => $this->status,
            'is_highlight' => $this->is_highlight,
            // 'published_at' => $this->published_at->isoFormat('DD-MM-YYYY h:m:s'),
            'published_at' => $this->published_at->format('d/m/Y H:i'),
            // 'updated_at' => $this->updated_at->isoFormat('DD-MM-YYYY h:m:s'),
            'updated_at' => $this->updated_at->format('d/m/Y H:i'),
            'author' => new UserResource($this->whenLoaded('author')),
            'user_id' => $this->user_id,
            'post_category_id' => $this->post_category_id,
        ];
    }
}


/*
'id'
'user_id'

'post_category_id

'title'
slug
'resume'
'content'

'thumbnail_url'

'reading_time'
'views'
'shares'
'status'
'is_highlight'
published_at

*/


/**


Perguntas sobre Laravel

1. O que são scopes e como usar?
2. Quando usar:

 protected $casts = ['published_at' => 'datetime','is_highlight' => 'boolean',];

    e quando usar:

    protected function casts(): array
    {
        return ['email_verified_at' => 'datetime',  'password' => 'hashed', ];
    }

    3. como preencher isso?
    class PostCategoryController extends Controller
    {

    public function index()
    {
        try {
            $postCategories = PostCategory::all();
            return response()->json([
                'postCategories' => $postCategories
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function store(Request $request){}
 */
