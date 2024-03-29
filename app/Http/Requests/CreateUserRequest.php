<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            "name" => "required|min:6|unique:users,name",
            "email" => "required|email|unique:users,email",
            "password" => "required|min:6|confirmed",
        ];
        if ($this->has('key') && $this->get('key') !== null) {
            $rules['key'] = 'required|min:32|max:32|exists:users,key';
        }
        return $rules;
    }
}
