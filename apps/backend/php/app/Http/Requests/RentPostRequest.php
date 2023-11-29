<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RentPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_id' => 'required|integer',
            'period_id' => "required|integer|in:1,2,3,4", // ToDo get list ids from rental_periods
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'product_id.required' => 'A product_id is required',
            'period_id.required' => 'A period_id is required',
            'period_id.in' => 'A period_id value should be only 1, 2, 3, 4',
        ];
    }
}
