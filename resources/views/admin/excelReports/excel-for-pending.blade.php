@extends('layouts.admin')
@section('content')
<div class="content">
    @can('excel_report_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.excel-reports.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.excelReportForPending.title_singular') }}
                </a>
                <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                    {{ trans('global.app_csvImport') }}
                </button>
                @include('csvImport.modal', ['model' => 'ExcelReport', 'route' => 'admin.excel-reports.parseCsvImport'])
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.excelReportForPending.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-ExcelReport">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.excelReportForPending.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.excelReportForPending.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.excelReportForPending.fields.email') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.excelReportForPending.fields.phone') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.excelReportForPending.fields.dob') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.excelReportForPending.fields.address') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.excelReportForPending.fields.location') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.excelReportForPending.fields.conductor') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.excelReportForPending.fields.module') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bookDate.fields.date') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $key => $student)
                                @if($student->status == 'pending')
                                    <tr data-entry-id="{{ $student->id }}">
                                        <td>
                                            {{ $index++ }}
                                        </td>
                                        <td>
                                            {{ $student->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $student->email ?? '' }}
                                        </td>
                                        <td>
                                            {{ $student->phone ?? '' }}
                                        </td>
                                        <td>
                                            {{ $student->dob ?? '' }}
                                        </td>
                                        <td>
                                            {{ $student->address ?? '' }}
                                        </td>
                                        <td>
                                            {{ $student->location->location ?? '' }}
                                        </td>
                                        <td>
                                            {{ $student->conductor->conductor ?? '' }}
                                        </td>
                                        <td>
                                            {{ $student->module->module ?? '' }}
                                        </td>
                                        <td>
                                            {{ $student->studentBookDate->date->available_date ?? '' }}
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('excel_report_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.excel-reports.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-ExcelReport:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection