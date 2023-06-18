<?php

namespace App\Http\Requests;

use App\Models\Room;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class UpdateRoomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $room = Room::find($this->route()->room->id);
        return $this->user()->isAdmin() || $room->user->is($this->user());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            "name" => "required",
            "address" => "required",
        ];
        if ($this->hasFile("image")) {
            $rules["image"] = ["required",
                File::image()->dimensions(Rule::dimensions()->minWidth(1280)->minHeight(720)),
            ];
        }
        return $rules;
    }
}
