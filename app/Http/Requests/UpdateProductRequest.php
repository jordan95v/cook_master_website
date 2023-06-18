<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $product = Product::find($this->route()->product->id);
        return $this->user()->isAdmin() || $product->user->is($this->user());
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
            $rules["image"] = "required|image|dimensions:min_width=1280,min_height=720";
        }
        return $rules;
    }
}
