<?php

namespace App\Infrastructure\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class OrderIngredientsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Ajusta según necesidades de autorización
    }

    public function rules(): array
    {
        return [
            'ingredients' => 'required|array',
            'ingredients.*.name' => ['required', 'string', 'exists:ingredients,name'],
            'ingredients.*.quantity' => 'required|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'ingredients.required' => 'The ingredients field is required.',
            'ingredients.array' => 'The ingredients field must be an array.',
            'ingredients.*.name.required' => 'The name of each ingredient is required.',
            'ingredients.*.name.string' => 'The name of each ingredient must be a string.',
            'ingredients.*.name.exists' => 'The ingredient name is not valid.',
            'ingredients.*.quantity.required' => 'The quantity of each ingredient is required.',
            'ingredients.*.quantity.integer' => 'The quantity of each ingredient must be an integer.',
            'ingredients.*.quantity.min' => 'The quantity of each ingredient must be at least 1.',
        ];
    }
}
