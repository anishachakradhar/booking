<?php

namespace App\Http\Requests;

use Gate;
use App\Student;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreStudentRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('student_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

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
            ],
            'module_id'          => [
                'required',
                'string',
            ],
            'location_id'     => [
                'required',
                'string',
            ],
        ];
    }
}
