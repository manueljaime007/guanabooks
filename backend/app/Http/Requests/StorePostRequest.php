<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:2'],
            'content' => ['required', 'string', 'min:2'],
            'resume' => ['required', 'string', 'min:2'],
            'thumbnail_url' => ['image', 'mimes:jpeg,png,jpg,gif,webp'],
            'post_category_id' => ['required', 'exists:post_category_id']
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Title is required!',
            'title.string' => 'Title MUST BE valid string required',
            'title.min' => 'Title MUST BE at least 2 chars',
            'resume.required' => 'Resume is required!',
            'resume.string' => 'Resume MUST BE valid string required',
            'resume.min' => 'Resume MUST BE at least 2 chars',
            'content.required' => 'Content is required!',
            'content.string' => 'Content MUST BE valid string required',
            'content.min' => 'Content MUST BE at least 2 chars',
        ];
    }
}


// return [
//             'id' => $this->id,
//             'title' => $this->title,
//             'slug' => Str::slug($this->title),
//             'resume' => $this->resume,
//             'content' => $this->content,
//             'thumbnail_url' => $this->thumbnail_url,
//             'reading_time' => $this->reading_time,
//             'views' => $this->views,
//             'shares' => $this->shares,
//             'status' => $this->status,
//             'is_highlight' => $this->is_highlight,
//             'published_at' => $this->published_at->isoFormat('DD-MM-YYYY h:m:s'),
//             'published_at' => $this->published_at->format('d/m/Y H:i'),
//             'updated_at' => $this->updated_at->isoFormat('DD-MM-YYYY h:m:s'),
//             'updated_at' => $this->updated_at->format('d/m/Y H:i'),
//             'author' => new UserResource($this->whenLoaded('author')),
//             'user_id' => $this->user_id,
//             'post_category_id' => $this->post_category_id,
//         ];
