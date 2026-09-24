<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'resume' => $this->resume,
            'content' => $this->content,
            'thumbnail_url' => $this->thumbnail_url
                ? asset('storage/' . $this->thumbnail_url)
                : null,
            'reading_time' => $this->reading_time,
            'views' => $this->views,
            'shares' => $this->shares,
            'status' => $this->status,
            'is_highlight' => $this->is_highlight,

            'published_at' => $this->published_at?->format('d/m/Y H:i'),
            'updated_at' => $this->updated_at->format('d/m/Y H:i'),

            'author' => new UserResource($this->whenLoaded('author')),
            'category' => new PostCategoryResource($this->whenLoaded('category')),
            'tags' => TagResource::collection($this->whenLoaded('tags')),

            // Usando withCount (mais eficiente)
            'likes' => $this->when(isset($this->likes_count), $this->likes_count, 0),
            'comments' => $this->when(isset($this->comments_count), $this->comments_count, 0),

            'user_id' => $this->user_id,
            'post_category_id' => $this->post_category_id,
        ];
    }
}
