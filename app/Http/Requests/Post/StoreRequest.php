<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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

     public function prepareForValidation()
     {
        // $this = $request
        $this->merge([
            'slug' => Str::slug($this->name, '-', 'en'),
            'description' => $this->description ?? 'No se proporcionó una descripción.',
        ]);
     }

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
            'description' => [
                'nullable',
                'string',
                'min:10',
                'max:85',
            ],
            'content' => [
                'required',
                'string',
                'min:5',
                'max:300',
                'regex:/^[a-zA-Z0-9\s.,!?]+$/',
            ],
            'status' => [
                'required',
                'in:DRAFT,PUBLISHED',
            ],
            'category_id' => [
                'required',
                'exists:categories,id',
            ],
            'slug' => [
                'required',
                Rule::unique('posts', 'slug')->ignore($this->post),
            ],
            'image' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg',
                'max:4048',
            ]
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
            'description.min' => 'La descripción debe tener al menos 10 caracteres.',
            'description.max' => 'La descripción no puede tener más de 85 caracteres.',
            'content.required' => 'El contenido del post es obligatorio.',
            'content.min' => 'El contenido debe tener al menos 5 caracteres.',
            'content.max' => 'El contenido no puede exceder los 300 caracteres.',
            'content.regex' => 'El contenido contiene caracteres no permitidos.',
            'status.required' => 'El estado del post es obligatorio.',
            'status.in' => 'El estado debe ser DRAFT o PUBLISHED.',
            'category_id.required' => 'Por favor, selecciona una categoría válida.',
            'category_id.exists' => 'La categoría seleccionada no existe.',
            'slug.required' => 'Fallo en el slug',
            'slug.unique' => 'Slug debe ser unico',
            'image.mimes' => 'Fallo en la imagen',
            'image.max' => 'Erro al guardar la imagen (4MB max).'
         ];
    }
}

