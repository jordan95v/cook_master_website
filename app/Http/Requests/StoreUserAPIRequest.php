<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;

class StoreUserAPIRequest extends FormRequest
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
            "password" => "required|min:6",
        ];
        if ($this->has('key')) {
            $rules['key'] = 'required|min:32|max:32|exists:users,key';
        }
        return $rules;
    }

    public function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'errors' => $validator->errors()->all(),
        ], 422);
        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }

    public function messages()
    {
        App::setLocale($this->lang ?? 'en');
        return [
            'name.required' => __('validation.required'),
            'name.min' => __('validation.min.string'),
            'name.unique' => __('validation.unique'),
            'email.required' => __('validation.required'),
            'email.email' => __('validation.email'),
            'email.unique' => __('validation.unique'),
            'password.required' => __('validation.required'),
            'password.min' => __('validation.min.string'),
            'key.required' => __('validation.required'),
            'key.min' => __('validation.min.string'),
            'key.max' => __('validation.max.string'),
            'key.exists' => __('validation.exists'),
        ];
    }
}
