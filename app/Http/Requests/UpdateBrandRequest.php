<?php

namespace App\Http\Requests;

use App\Models\Brand;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBrandRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $brand = Brand::find($this->route()->brand->id);
        return $this->user()->isAdmin() || $brand->user->is($this->user());
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
            $rules["image"] = "required|image|dimensions:min_width=1280,min_height=720";
        }
        return $rules;
    }
}
