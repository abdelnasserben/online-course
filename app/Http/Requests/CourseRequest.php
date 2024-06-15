<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CourseRequest extends FormRequest
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
            'title' => 'required|string|min:4',
            'picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'short_description' => 'required|string|between:4,150', //sera 80 à 150
            'description' => 'required|string|min:4', //min sera 255
            'topic_id' => ['required', 'integer', Rule::exists('topics', 'id')],
            'level' => ['required', Rule::in(['debutant', 'intermediaire', 'avance'])],
            'trainers' => ['required', 'array', 'exists:trainers,id'],
            'is_premium' => 'string',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Le titre est obligatoire.',
            'title.min' => 'Le titre doit avoir au moins :min caractères.',

            'picture.image' => 'La photo doit être une image.',
            'picture.mimes' => 'La photo doit être un fichier de type : jpg, jpeg, png.',
            'picture.max' => 'La photo ne doit pas dépasser 2MB.',

            'short_description.required' => 'Une brève description du cours est requise.',
            'short_description.between' => 'La brève description du cours doit contenir entre :min et :max caractères.',

            'description.required' => 'La description est obligatoire.',
            'description.min' => 'La description doit avoir au moins :min caractères.',

            'topic_id.required' => 'La catégorie est obligatoire.',
            'topic_id.exists' => 'La catégorie est invalide.',

            'level.required' => 'Le niveau est obligatoire.',
            'level.in' => 'Le niveau est invalide.',

            'trainers.required' => 'Sélectionnez au moins un formateur.',
            'trainers.array' => 'Le formateur est invalide.',
            'trainers.*.exists' => 'Le formateur est invalide.',
        ];
    }
}
