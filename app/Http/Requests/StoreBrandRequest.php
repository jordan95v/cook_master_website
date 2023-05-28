<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBrandRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->isAdmin() || $this->user()->is_service_provider;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required|unique:brands,name",
            "image" => "required|image|dimensions:min_width=1280,min_height=720",
            "description" => "required",
            "website" => "required|url",
            "contact_email" => "required|email|unique:brands,contact_email",
        ];
    }
}
