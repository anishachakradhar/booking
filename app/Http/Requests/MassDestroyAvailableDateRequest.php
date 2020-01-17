<?php

namespace App\Http\Requests;

use App\AvailableDate;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAvailableDateRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('available_date_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:available_dates,id',
        ];
    }
}
