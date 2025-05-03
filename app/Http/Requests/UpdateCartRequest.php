<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCartRequest extends FormRequest
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
            'quantity' => 'required|integer|min:1'
        ];
    }

    /**
     * Get the custom validation messages for the request.
     *
     * @return array An associative array of custom validation messages.
     *               Keys represent validation rules, and values are the corresponding error messages.
     */
    public function messages(): array
    {
        return [
            'quantity.required' => 'The quantity field is required.',
            'quantity.integer' => 'The quantity must be a valid number.',
            'quantity.min' => 'The quantity must be at least 1.',
        ];
    }
}
