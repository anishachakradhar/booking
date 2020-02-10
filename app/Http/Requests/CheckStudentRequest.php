<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'            => [
                'required',
            ],
            'email'           => [
                'required',
            ],
            'phone'           => [
                'required',
                'integer',
                'digits:10'
            ],
            'address'         => [
                'required',
            ],
            'dob'             => [
                'required',
                'date',
                'date_format:' . config('panel.date_format'),
                'before:today',
            ],
            'passport_number' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'passport_photo'  => [
                'required',
            ],
            'conductor_id'       => [
                'required',
                'string',
                'exists:conductors,conductor_id'
            ],
            'module_id'          => [
                'required',
                'string',
                'exists:modules,module_id'
            ],
            'location_id'     => [
                'required',
                'string',
                'exists:locations,location_id'
            ],
            'book_date_id'  =>  [
                'required',
                'exists:book_dates,book_date_id'
            ],
            'temp_booking_code' => [
                'nullable'
            ],
        ];
    }
}
