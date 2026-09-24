<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'resume' => $this->resume,
            'thumbnail_url' => $this->thumbnail_url,
            'pdf_url' => $this->thumbnail_url,
            'downloads' => $this->downloads,
            'shares' => $this->shares,
            'status' => $this->status,
            'is_highlight' => $this->is_highlight,
            'published_at' => $this->published_at->format('d/m/Y H:i'),
            'updated_at' => $this->updated_at->format('d/m/Y H:i'),
            'author' => new UserResource($this->whenLoaded('author')),
            'user_id' => $this->user_id,
            'book_category_id' => $this->book_category_id,
        ];
    }
}
