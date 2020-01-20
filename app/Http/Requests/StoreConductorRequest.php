<?php

namespace App\Http\Requests;

use App\Conductor;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreConductorRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('conductor_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
        ];
    }
}
