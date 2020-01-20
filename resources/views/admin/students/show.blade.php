@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.student.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.students.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.student.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $student->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.student.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $student->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.student.fields.email') }}
                                    </th>
                                    <td>
                                        {{ $student->email }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.student.fields.phone') }}
                                    </th>
                                    <td>
                                        {{ $student->phone }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.student.fields.address') }}
                                    </th>
                                    <td>
                                        {{ $student->address }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.student.fields.dob') }}
                                    </th>
                                    <td>
                                        {{ $student->dob }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.student.fields.consultancy_name') }}
                                    </th>
                                    <td>
                                        {{ $student->consultancy_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.student.fields.passport_number') }}
                                    </th>
                                    <td>
                                        {{ $student->passport_number }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.student.fields.passport_photo') }}
                                    </th>
                                    <td>
                                        @if($student->passport_photo)
                                            <a href="{{ $student->passport_photo->getUrl() }}" target="_blank">
                                                <img src="{{ $student->passport_photo->getUrl('thumb') }}" width="50px" height="50px">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.student.fields.conductor') }}
                                    </th>
                                    <td>
                                        {{ $student->conductor->conductor ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.student.fields.module') }}
                                    </th>
                                    <td>
                                        {{ $student->module->module ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.student.fields.location') }}
                                    </th>
                                    <td>
                                        {{ $student->location->location ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.student.fields.status') }}
                                    </th>
                                    <td>
                                        {{ App\Student::STATUS_SELECT[$student->status] ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.students.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.relatedData') }}
                </div>
                <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
                    <li role="presentation">
                        <a href="#name_excel_reports" aria-controls="name_excel_reports" role="tab" data-toggle="tab">
                            {{ trans('cruds.excelReport.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#email_excel_reports" aria-controls="email_excel_reports" role="tab" data-toggle="tab">
                            {{ trans('cruds.excelReport.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#phone_excel_reports" aria-controls="phone_excel_reports" role="tab" data-toggle="tab">
                            {{ trans('cruds.excelReport.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#dob_excel_reports" aria-controls="dob_excel_reports" role="tab" data-toggle="tab">
                            {{ trans('cruds.excelReport.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#students_email_book_dates" aria-controls="students_email_book_dates" role="tab" data-toggle="tab">
                            {{ trans('cruds.bookDate.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#address_excel_reports" aria-controls="address_excel_reports" role="tab" data-toggle="tab">
                            {{ trans('cruds.excelReport.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#consultancy_name_excel_reports" aria-controls="consultancy_name_excel_reports" role="tab" data-toggle="tab">
                            {{ trans('cruds.excelReport.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#location_excel_reports" aria-controls="location_excel_reports" role="tab" data-toggle="tab">
                            {{ trans('cruds.excelReport.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#conductor_excel_reports" aria-controls="conductor_excel_reports" role="tab" data-toggle="tab">
                            {{ trans('cruds.excelReport.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#module_excel_reports" aria-controls="module_excel_reports" role="tab" data-toggle="tab">
                            {{ trans('cruds.excelReport.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="name_excel_reports">
                        @includeIf('admin.students.relationships.nameExcelReports', ['excelReports' => $student->nameExcelReports])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="email_excel_reports">
                        @includeIf('admin.students.relationships.emailExcelReports', ['excelReports' => $student->emailExcelReports])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="phone_excel_reports">
                        @includeIf('admin.students.relationships.phoneExcelReports', ['excelReports' => $student->phoneExcelReports])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="dob_excel_reports">
                        @includeIf('admin.students.relationships.dobExcelReports', ['excelReports' => $student->dobExcelReports])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="students_email_book_dates">
                        @includeIf('admin.students.relationships.studentsEmailBookDates', ['bookDates' => $student->studentsEmailBookDates])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="address_excel_reports">
                        @includeIf('admin.students.relationships.addressExcelReports', ['excelReports' => $student->addressExcelReports])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="consultancy_name_excel_reports">
                        @includeIf('admin.students.relationships.consultancyNameExcelReports', ['excelReports' => $student->consultancyNameExcelReports])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="location_excel_reports">
                        @includeIf('admin.students.relationships.locationExcelReports', ['excelReports' => $student->locationExcelReports])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="conductor_excel_reports">
                        @includeIf('admin.students.relationships.conductorExcelReports', ['excelReports' => $student->conductorExcelReports])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="module_excel_reports">
                        @includeIf('admin.students.relationships.moduleExcelReports', ['excelReports' => $student->moduleExcelReports])
                    </div>
                </div>
            </div> --}}

        </div>
    </div>
</div>
@endsection