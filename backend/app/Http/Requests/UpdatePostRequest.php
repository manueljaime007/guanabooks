<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class UpdatePostRequest extends FormRequest
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
            'title' => [
                'string',
                'min:2'
            ],
            'content' => [
                'string',
            ],
            'resume' => [
                'string',
            ],
            'post_category_id' => [
                'exists:post_categories,id'
            ],
            'thumbnail' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif,webp',
                'max:5120'
            ],
            'status' => [
                'in:draft,published,archived'
            ],
        ];
    }
}
