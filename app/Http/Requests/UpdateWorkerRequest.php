<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateWorkerRequest extends FormRequest
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
        // Obtém o ID do usuário da rota
        $workerID = $this->route('workerID');

        return [
            'name' => 'required|string',
            'email' => [
                'nullable',
                'email',
                Rule::unique('workers')->ignore($workerID),
            ],
            'photo' => 'nullable|image|max:2048|mimes:png,jpg',
            'phone_mobile' => 'nullable|string',
            'phone_other' => 'nullable|string',
            'address_country' => 'nullable|string',
            'address_state' => 'nullable|string',
            'address_city' => 'nullable|string',
            'address_street' => 'nullable|string',
            'date_birth' => 'nullable|date|date_format:Y-m-d',
            'gender' => 'required|in:M,F',
            'bi' => [
                'nullable',
                'string',
                Rule::unique('workers')->ignore($workerID),
            ],
            'category_id' => 'required|exists:categories,id',
        ];
    }
}