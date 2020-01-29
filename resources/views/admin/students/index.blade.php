@extends('layouts.admin')
@section('content')
<div class="content">
    @can('student_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.students.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.student.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.student.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Student">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.student.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.student.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.student.fields.email') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.student.fields.phone') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.student.fields.address') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.student.fields.dob') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.student.fields.passport_number') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.student.fields.passport_photo') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.student.fields.conductor') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.student.fields.module') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.student.fields.location') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.student.fields.status') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $key => $student)
                                    <tr data-entry-id="{{ $student->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $loop->iteration }}
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
                                            {{ $student->address ?? '' }}
                                        </td>
                                        <td>
                                            {{ $student->dob ?? '' }}
                                        </td>
                                        <td>
                                            {{ $student->passport_number ?? '' }}
                                        </td>
                                        <td>
                                            @if($student->passport_photo)
                                                <a href="{{ $student->passport_photo->getUrl() }}" target="_blank">
                                                    <img src="{{ $student->passport_photo->getUrl('thumb') }}" width="50px" height="50px">
                                                </a>
                                            @endif
                                        </td>
                                        {{-- <td>
                                            {{ App\Student::CONDUCTOR_SELECT[$student->conductor] ?? '' }}
                                        </td> --}}
                                        {{-- <td>
                                            {{ App\Student::MODULE_SELECT[$student->module] ?? '' }}
                                        </td> --}}
                                        <td>
                                            {{ $student->conductor->conductor ?? '' }}
                                        </td>
                                        <td>
                                            {{ $student->module->module ?? '' }}
                                        </td>
                                        <td>
                                            {{ $student->location->location ?? '' }}
                                        </td>
                                        <td>
                                            {{ $student->status_name ?? '' }}
                                        </td>
                                        <td>
                                            @can('student_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.students.show', $student->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('student_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.students.edit', $student->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('student_delete')
                                                <form action="{{ route('admin.students.destroy', $student->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('student_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.students.massDestroy') }}",
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
  $('.datatable-Student:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection