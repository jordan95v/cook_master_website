<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class StoreBrandRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->isAdmin();
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
            "image" => ["required",
                File::image()->dimensions(Rule::dimensions()->minWidth(1280)->minHeight(720)),
            ],
            "description" => "required",
            "website" => "required|url",
            "contact_email" => "required|email|unique:brands,contact_email",
        ];
    }
}
