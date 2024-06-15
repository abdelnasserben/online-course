<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'content' => 'required|string|min:4',
            'tutorial_id' => 'required|exists:tutorials,id',
        ];
    }

    public function messages()
    {
        return [
            'content.required' => 'Le commentaire est requis.',
            'content.min' => 'Le commentaire doit avoir au moins 4 caractères.',
            'tutorial_id.required' => 'Le tutoriel est requis.',
            'tutorial_id.exists' => 'Le tutoriel n\'existe pas.',
        ];
    }
}
