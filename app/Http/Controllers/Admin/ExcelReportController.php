<?php

namespace App\Http\Controllers\Admin;

use Gate;
use App\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class ExcelReportController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('excel_report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $students = Student::all();
        $index = 1;

        return view('admin.excelReports.index', compact('students', 'index'));
    }

    public function create()
    {
        //
    }

    public function store()
    {
        //
    }

    public function edit()
    {
        //
    }

    public function update()
    {
        //
    }

    public function show()
    {
        //
    }

    public function destroy()
    {
        //
    }

    public function massDestroy()
    {
        //
    }
}
