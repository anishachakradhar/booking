<?php

namespace App\Http\Requests;

use App\Student;
use Gate;
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
                'unique:students',
            ],
            'phone'           => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'address'         => [
                'required',
            ],
            'dob'             => [
                'required',
                'date_format:' . config('panel.date_format'),
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
            'conductor'       => [
                'required',
            ],
            'module'          => [
                'required',
            ],
            'location_id'     => [
                'required',
                'integer',
            ],
            'status'          => [
                'required',
            ],
        ];
    }
}
