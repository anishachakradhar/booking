<?php

namespace App\Http\Requests;

use App\Conductor;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyConductorRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('conductor_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:conductors,id',
        ];
    }
}
