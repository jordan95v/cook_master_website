<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Leaving that here just in case.
        // if ($this->get("role") || $this->get("is_banned") || $this->get("is_service_provider")) {
        //     return redirect()->route("users.create")->with("error", "You cannot edit that field.");
        // }
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
            "name" => "required|unique:users,name," . Auth::id(),
            "email" => "required|unique:users,email," . Auth::id(),
        ];
        if ($this->request->get("password")) {
            $rules['password'] = "required|confirmed|min:6";
        };
        return $rules;
    }
}
