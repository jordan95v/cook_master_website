<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->isAdmin()  || $this->user()->is_service_provider;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            "name" => "required|min:6",
            "brand_id" => "required",
            "price" => "required",
            "description" => "required",
        ];
        if ($this->hasFile("image")) {
            $rules["image"] = [
                "required",
                File::image()->dimensions(Rule::dimensions()->minWidth(1280)->minHeight(720)),
            ];
        }
        return $rules;
    }
}
