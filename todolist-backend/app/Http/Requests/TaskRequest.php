<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            'title' => 'required|string|max:150',
            'description' => 'required|string',
            'status' => 'required|in:pending,in_progress,completed',
        ];
    }

    public function messages () : array {
        return [
            'title.required' => 'El titulo es obligatorio',
            'title.string' => 'El titulo debe ser una cadena de texto',
            'title.max' => 'El titulo no debe exceder los 150 caracteres',

            'description.string' => 'La descripcion debe ser una cadena de texto',
            'description.required' => 'El descripcion es obligatorio',

            'status.required' => 'El estado es obligatorio',
            'status.in' => 'El estado debe ser uno de los siguientes: pending,  completed',
        ];
    }
}
