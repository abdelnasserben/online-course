<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SectionRequest extends FormRequest
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
            'title' => 'required|string|min:4|max:255',
            'course_id' => 'required|integer|exists:courses,id',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Le titre est requis.',
            'title.min' => 'Le titre doit avoir au moins 4 caractères.',
            'title.max' => 'Le titre ne peut pas dépasser 255 caractères.',
            'course_id.required' => 'Le cours est requis.',
            'course_id.exists' => 'Le cours n\'existe pas.',
        ];
    }
}
