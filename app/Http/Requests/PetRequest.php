<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PetRequest extends FormRequest
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
          'id' => 'sometimes|required|integer|min:0',
          'category' => 'sometimes|nullable|string|max:255',
          'photoUrl' => 'sometimes|string',
          'name' => 'sometimes|required|string|max:255',
          'status' => 'sometimes|nullable|string|in:available,pending,sold',
        ];
    }
}
