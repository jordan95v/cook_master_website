<?php

namespace App\Http\Requests;

use App\Models\Equipment;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class UpdateEquipmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $equipment = Equipment::find($this->route()->equipment->id);
        return $this->user()->isAdmin() || $equipment->user->is($this->user());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            "title" => "required",
            "brand_id" => "required",
        ];
        if ($this->hasFile("image")) {
            $rules["image"] = ["required",
                File::image()->dimensions(Rule::dimensions()->minWidth(1280)->minHeight(720)),
            ];
        }
        return $rules;
    }
}
