<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCoursesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required|min:10|unique:courses,name",
            "image" => "required|image|dimensions:min_width=1280,min_height=720",
            "difficulty" => "required|in:1,2,3,4,5",
            "duration" => "required|integer",
            "content" => "required|min:10",
        ];
    }
}
