<div class="content">
    @can('excel_report_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.excel-reports.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.excelReport.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.excelReport.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-ExcelReport">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.excelReport.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.excelReport.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.excelReport.fields.email') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.excelReport.fields.phone') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.excelReport.fields.dob') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.excelReport.fields.address') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.excelReport.fields.consultancy_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.excelReport.fields.location') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.excelReport.fields.conductor') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.excelReport.fields.module') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($excelReports as $key => $excelReport)
                                    <tr data-entry-id="{{ $excelReport->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $excelReport->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $excelReport->name->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $excelReport->email->email ?? '' }}
                                        </td>
                                        <td>
                                            {{ $excelReport->phone->phone ?? '' }}
                                        </td>
                                        <td>
                                            {{ $excelReport->dob->dob ?? '' }}
                                        </td>
                                        <td>
                                            {{ $excelReport->address->address ?? '' }}
                                        </td>
                                        <td>
                                            {{ $excelReport->consultancy_name->consultancy_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $excelReport->location->available_date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $excelReport->conductor->conductor ?? '' }}
                                        </td>
                                        <td>
                                            {{ $excelReport->module->module ?? '' }}
                                        </td>
                                        <td>
                                            @can('excel_report_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.excel-reports.show', $excelReport->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('excel_report_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.excel-reports.edit', $excelReport->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('excel_report_delete')
                                                <form action="{{ route('admin.excel-reports.destroy', $excelReport->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                </form>
                                            @endcan

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
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
    order: [[ 1, 'asc' ]],
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