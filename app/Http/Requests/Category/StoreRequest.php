<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => ['forbidden'],
            'name' => [
                'required',
                'string',
                'min:5',
                'max:50',
            ],
            'slug' => [
                'required',
                Rule::unique('category', 'slug')->ignore($this->category),
            ],

        ]; 
    }

    public function passedValidation()
    {
        //
    }

    public function messages(): array
    {
        return [
            'id.forbidden' => 'Error.',
            'name.required' => 'Por favor, ingresa un nombre para el post.',
            'name.min' => 'El nombre del post debe contener al menos 5 caracteres.',
            'name.max' => 'El nombre del post no puede exceder los 50 caracteres.',
            'name.string' => 'El nombre del post debe ser una cadena de texto.',
            'slug.required' => 'Fallo en el slug',
            'slug.unique' => 'Slug debe ser unico',
         ];
    }
}
