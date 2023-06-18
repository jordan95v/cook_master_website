<?php

namespace App\Http\Requests;

use App\Models\Event;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $event = Event::find($this->route()->event->id);
        return $this->user()->isAdmin() || $event->user->is($this->user());
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
            "is_course" => "required",
            "description" => "required",
            "room_id" => "required",
            "capacity" => "required",
            "date" => "required|date_format:Y-m-d",
            "start_time" => "required|date_format:H:i",
            "end_time" => "required|date_format:H:i",
        ];
        if ($this->hasFile("image")) {
            $rules["image"] = "required|image|dimensions:min_width=1280,min_height=720";
        }
        return $rules;
    }
}
