<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
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
            'room'=>'required',
            'hostel_id'=>'required',
            'capacity'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'hostel_id.required' => 'The hostel field is required.',

        ];
    }
}
