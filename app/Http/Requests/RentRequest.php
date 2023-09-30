<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RentRequest extends FormRequest
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
            'hostel_id'=>'required',
            'bed_type'=>'required',
            'monthly_fee'=>'required',
            'start_date'=>'required',
            'end_date'=>'nullable',
            
        ];

    }
    public function messages()
    {
        return [
            'hostel_id.required' => 'The hostel field is required.',
            'bed_type.required' => 'The bed type field is required.',
            'monthly_fee.required' => 'The monthly fee field is required.',
            'start_date.required' => 'The start date field is required.',

        ];
    }
}
