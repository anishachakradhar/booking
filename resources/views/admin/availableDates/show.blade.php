@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.availableDate.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.available-dates.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.availableDate.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $availableDate->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.availableDate.fields.available_date') }}
                                    </th>
                                    <td>
                                        {{ $availableDate->available_date }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.available-dates.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.relatedData') }}
                </div>
                <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
                    <li role="presentation">
                        <a href="#location_excel_reports" aria-controls="location_excel_reports" role="tab" data-toggle="tab">
                            {{ trans('cruds.excelReport.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#date_book_dates" aria-controls="date_book_dates" role="tab" data-toggle="tab">
                            {{ trans('cruds.bookDate.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="location_excel_reports">
                        @includeIf('admin.availableDates.relationships.locationExcelReports', ['excelReports' => $availableDate->locationExcelReports])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="date_book_dates">
                        @includeIf('admin.availableDates.relationships.dateBookDates', ['bookDates' => $availableDate->dateBookDates])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection