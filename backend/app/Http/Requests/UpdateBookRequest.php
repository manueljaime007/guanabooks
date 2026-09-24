<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
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
                'max:255'
            ],
            'resume' => [
                'string'
            ],
            'pdf' => [
                'nullable',
                'file',
                'mimes:pdf',
                'max:51200'
            ],
            'thumbnail' => [
                'nullable',
                'image',
                'mimes:jpeg,png,webp',
                'max:5120'
            ],
            'status' => [
                'in:draft',
                'published',
                'archived'
            ],
        ];
    }
}
