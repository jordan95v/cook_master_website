<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
            'comment' => 'required',
            'address' => 'required',
            "date" => "required|date_format:Y-m-d",
            "start_time" => "required|date_format:H:i",
            "end_time" => "required|date_format:H:i",
        ];
    }
}
