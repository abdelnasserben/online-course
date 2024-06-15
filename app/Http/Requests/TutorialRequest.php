<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TutorialRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'video_url' => 'required|url',
            'is_premium' => 'string',
            'section_id' => 'required|exists:sections,id',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Le titre du tutoriel est requis.',
            'title.max' => 'Le titre du tutoriel ne peut pas dépasser 255 caractères.',
            'description.required' => 'La description du tutoriel est requise.',
            'description.min' => 'La description doit avoir au moins 10 caractères.',
            'video_url.required' => 'L\'URL de la vidéo du tutoriel est requise.',
            'video_url.url' => 'L\'URL de la vidéo du tutoriel doit être une URL valide.',
            'is_premium.boolean' => 'La valeur de l\'indicateur de premium doit être un booléen.',
            'section_id.required' => 'L\'identifiant de la section du tutoriel est requis.',
            'section_id.exists' => 'La section sélectionnée n\'existe pas.',
        ];
    }
}
