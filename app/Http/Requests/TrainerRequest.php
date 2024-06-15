<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TrainerRequest extends FormRequest
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
            'name' => 'required|string|min:4',
            'title' => 'required|string|min:4',
            'description' => 'required|string|min:10',
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048', Rule::requiredIf($this->isMethod('post'))],
            'github' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'twitter' => 'nullable|url',
            'website' => 'nullable|url',
        ];
    }

    /**
     * Get custom error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Le nom est obligatoire.',
            'name.min' => 'Le nom doit contenir au moins 4 caractères.',
            'title.required' => 'Le titre est obligatoire.',
            'title.min' => 'Le titre doit contenir au moins 4 caractères.',
            'description.required' => 'La description est obligatoire.',
            'description.min' => 'La description doit contenir au moins 10 caractères.',
            'photo.required' => 'La photo est obligatoire.',
            'photo.image' => 'La photo doit être une image.',
            'photo.mimes' => 'La photo doit être un fichier de type : jpg, jpeg, png.',
            'photo.max' => 'La photo ne doit pas dépasser 2MB.',
            'github.url' => 'L\'URL GitHub doit être une URL valide.',
            'linkedin.url' => 'L\'URL LinkedIn doit être une URL valide.',
            'twitter.url' => 'L\'URL Twitter doit être une URL valide.',
            'website.url' => 'L\'URL du site web doit être une URL valide.',
        ];
    }
}
