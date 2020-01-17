<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\ExcelReport;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExcelReportRequest;
use App\Http\Requests\UpdateExcelReportRequest;
use App\Http\Resources\Admin\ExcelReportResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ExcelReportApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('excel_report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ExcelReportResource(ExcelReport::with(['name', 'email', 'phone', 'dob', 'address', 'consultancy_name', 'location', 'conductor', 'module'])->get());
    }

    public function store(StoreExcelReportRequest $request)
    {
        $excelReport = ExcelReport::create($request->all());

        return (new ExcelReportResource($excelReport))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ExcelReport $excelReport)
    {
        abort_if(Gate::denies('excel_report_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ExcelReportResource($excelReport->load(['name', 'email', 'phone', 'dob', 'address', 'consultancy_name', 'location', 'conductor', 'module']));
    }

    public function update(UpdateExcelReportRequest $request, ExcelReport $excelReport)
    {
        $excelReport->update($request->all());

        return (new ExcelReportResource($excelReport))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ExcelReport $excelReport)
    {
        abort_if(Gate::denies('excel_report_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $excelReport->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
