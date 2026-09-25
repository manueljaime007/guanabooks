<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:books',
            'resume' => 'required|string',
            'book_category_id' => 'required|uuid|exists:book_categories,id',
            'pdf' => 'required|file|mimes:pdf|max:51200',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,webp|max:5120',
            'cover' => 'nullable|image|mimes:jpeg,png,webp|max:10240',
            'status' => 'in:draft,published,archived',
        ];
    }
}
