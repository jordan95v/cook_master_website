<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class StoreEventRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "title" => "required",
            "description" => "required",
            "image" => [
                "required",
                File::image()->dimensions(Rule::dimensions()->minWidth(1280)->minHeight(720)),
            ],
            "room_id" => "required",
            "capacity" => "required",
            "date" => "required|date_format:Y-m-d",
            "start_time" => "required|date_format:H:i",
            "end_time" => "required|date_format:H:i",
        ];
    }
}
