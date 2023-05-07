<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'user_name' => 'required|string|unique:users,user_name',
            'email' => 'required|email',
            'photo' => 'nullable|file|mimes:png,jpg',
            'phone_mobile' => 'nullable|string',
            'phone_other' => 'nullable|string',
            'address_country' => 'nullable|string',
            'address_state' => 'nullable|string',
            'address_city' => 'nullable|string',
            'address_street' => 'nullable|string',
            'date_birth' => 'required|date|date_format:Y-m-d',
            'gender' => 'required|in:M,F',
            'bi' => 'required|string|size:14',
        ];
    }
}