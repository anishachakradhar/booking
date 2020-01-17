<?php

namespace App\Http\Requests;

use App\BookDate;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyBookDateRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('book_date_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:book_dates,id',
        ];
    }
}
