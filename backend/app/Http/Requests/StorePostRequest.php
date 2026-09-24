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
            'title' => [
                'required',
                'string',
                'min:2'
            ],
            'content' => [
                'required',
                'string',
                'min:2'
            ],
            'resume' => [
                'required',
                'string',
                'min:2'
            ],
            'thumbnail' => [
                'image',
                'mimes:jpeg,png,jpg,gif,webp'
            ],
            'post_category_id' => [
                'required',
                'exists:post_categories,id'
            ],
            'status' => [
                'in:draft,published,archived'
            ],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'O título é obrigatório!',
            'title.string' => 'O título deve ser uma string válida',
            'title.min' => 'O título deve ter pelo menos 2 caracteres',
            'title.max' => 'O título deve ter no máximo 255 caracteres',

            'content.required' => 'O conteúdo é obrigatório!',
            'content.string' => 'O conteúdo deve ser uma string válida',
            'content.min' => 'O conteúdo deve ter pelo menos 10 caracteres',

            'resume.required' => 'O resumo é obrigatório!',
            'resume.string' => 'O resumo deve ser uma string válida',
            'resume.min' => 'O resumo deve ter pelo menos 10 caracteres',
            'resume.max' => 'O resumo deve ter no máximo 500 caracteres',

            'thumbnail.image' => 'O arquivo deve ser uma imagem',
            'thumbnail.mimes' => 'A imagem deve ser do tipo: jpeg, png, jpg, gif ou webp',
            'thumbnail.max' => 'A imagem deve ter no máximo 5MB',

            'post_category_id.required' => 'A categoria é obrigatória!',
            'post_category_id.exists' => 'A categoria selecionada não existe!',

            'status.in' => 'O status deve ser: draft, published ou archived',

            'is_highlight.boolean' => 'O campo destaque deve ser verdadeiro ou falso',

            'published_at.date' => 'A data de publicação deve ser uma data válida',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            // Se não enviar status, define como 'draft'
            'status' => $this->status ?? 'draft',
            // Se não enviar is_highlight, define como false
            'is_highlight' => $this->is_highlight ?? false,
        ]);
    }
}
