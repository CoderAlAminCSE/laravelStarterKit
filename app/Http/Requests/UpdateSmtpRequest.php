<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSmtpRequest extends FormRequest
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
            'driver' => 'required',
            'port' => 'required',
            'username' => 'required',
            'from' => 'required',
            'host' => 'required',
            'password' => 'required',
            'from_name' => 'required',
            'encryption' => 'sometimes',
        ];
    }
}
