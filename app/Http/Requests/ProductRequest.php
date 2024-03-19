<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => ['required', 'string', 'alpha', 'min:3', 'max:255'],
            'image' => ['required', 'file', 'extensions:jpg,png'],
            'price' => ['required', 'integer', 'min:2'],
            'quantity' => ['required', 'numeric', 'min:2'],
            'description' => ['nullable', 'string',]

        ];
    }
}
