<?php

namespace App\Http\Requests;

use App\Student;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateStudentRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('student_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
                'unique:students,email,' . request()->route('student')->id,
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
            'conductor_id'       => [
                'required',
            ],
            'module_id'          => [
                'required',
            ],
            'location_id'     => [
                'required',
            ],
            'status'          => [
                'required',
            ],
        ];
    }
}
