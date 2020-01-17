<?php

namespace App\Http\Requests;

use App\ExcelReport;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateExcelReportRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('excel_report_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
        ];
    }
}
