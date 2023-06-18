<?php

namespace App\Http\Requests;

use App\Models\Formation;
use Illuminate\Foundation\Http\FormRequest;

class UpdateFormationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $formation = Formation::find($this->route()->formation->id);
        return $this->user()->isAdmin() || $formation->user->is($this->user());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $id = $this->route("formation")->id;
        $rules = [
            "name" => "required|min:7|unique:formations,name,{$id}",
            "description" => "required|min:10",
        ];
        if ($this->hasFile("image")) {
            $rules["image"] = "required|image|dimensions:min_width=1280,min_height=720";
        }
        return $rules;
    }
}
