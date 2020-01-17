@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.excelReport.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.excel-reports.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.excelReport.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $excelReport->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.excelReport.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $excelReport->name->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.excelReport.fields.email') }}
                                    </th>
                                    <td>
                                        {{ $excelReport->email->email ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.excelReport.fields.phone') }}
                                    </th>
                                    <td>
                                        {{ $excelReport->phone->phone ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.excelReport.fields.dob') }}
                                    </th>
                                    <td>
                                        {{ $excelReport->dob->dob ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.excelReport.fields.address') }}
                                    </th>
                                    <td>
                                        {{ $excelReport->address->address ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.excelReport.fields.consultancy_name') }}
                                    </th>
                                    <td>
                                        {{ $excelReport->consultancy_name->consultancy_name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.excelReport.fields.location') }}
                                    </th>
                                    <td>
                                        {{ $excelReport->location->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.excelReport.fields.conductor') }}
                                    </th>
                                    <td>
                                        {{ $excelReport->conductor->conductor ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.excelReport.fields.module') }}
                                    </th>
                                    <td>
                                        {{ $excelReport->module->module ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.excel-reports.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection