<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        $rules = [
            "title" => "required",
            "description" => "required",
            "image" => "required|image|dimensions:min_width=1280,min_height=720",
            "user_id" => "required",
            "room_id" => "required",
            "capacity" => "required",
            "date" => "required|date_format:Y-m-d",
            "start_time" => "required|date_format:H:i:s",
            "end_time" => "required|date_format:H:i:s",
        ];
        if ($this->has("is_course")) {
            $rules["is_course"] = "required";
        }
        return $rules;
    }
}
