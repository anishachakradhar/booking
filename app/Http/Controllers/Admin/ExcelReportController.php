<?php

namespace App\Http\Controllers\Admin;

use App\ExcelReport;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyExcelReportRequest;
use App\Http\Requests\StoreExcelReportRequest;
use App\Http\Requests\UpdateExcelReportRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ExcelReportController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('excel_report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $excelReports = ExcelReport::all();

        return view('admin.excelReports.index', compact('excelReports'));
    }

    public function create()
    {
        abort_if(Gate::denies('excel_report_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.excelReports.create');
    }

    public function store(StoreExcelReportRequest $request)
    {
        $excelReport = ExcelReport::create($request->all());

        return redirect()->route('admin.excel-reports.index');
    }

    public function edit(ExcelReport $excelReport)
    {
        abort_if(Gate::denies('excel_report_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $excelReport->load('name', 'email', 'phone', 'dob', 'address', 'consultancy_name', 'location', 'conductor', 'module');

        return view('admin.excelReports.edit', compact('excelReport'));
    }

    public function update(UpdateExcelReportRequest $request, ExcelReport $excelReport)
    {
        $excelReport->update($request->all());

        return redirect()->route('admin.excel-reports.index');
    }

    public function show(ExcelReport $excelReport)
    {
        abort_if(Gate::denies('excel_report_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $excelReport->load('name', 'email', 'phone', 'dob', 'address', 'consultancy_name', 'location', 'conductor', 'module');

        return view('admin.excelReports.show', compact('excelReport'));
    }

    public function destroy(ExcelReport $excelReport)
    {
        abort_if(Gate::denies('excel_report_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $excelReport->delete();

        return back();
    }

    public function massDestroy(MassDestroyExcelReportRequest $request)
    {
        ExcelReport::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
