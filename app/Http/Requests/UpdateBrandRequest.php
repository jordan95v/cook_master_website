<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class UpdateBrandRequest extends FormRequest
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
        $id = $this->route()->brand->id;
        $rules = [
            "name" => "required|unique:brands,name,$id",
            "description" => "required",
            "website" => "required|url",
            "contact_email" => "required|email|unique:brands,contact_email,$id",
        ];
        if ($this->hasFile("image")) {
            $rules["image"] = ["required",
                File::image()->min(1)->max(12 * 1024)->dimensions(Rule::dimensions()->minWidth(1280)->minHeight(720)),
            ];
        }
        return $rules;
    }
}
