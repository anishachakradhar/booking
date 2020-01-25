@extends('layouts.admin')
@section('content')
<div class="content">
    {{-- @can('book_date_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.book-dates.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.bookDate.title_singular') }}
                </a>
            </div>
        </div>
    @endcan --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.bookDate.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-BookDate">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.bookDate.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bookDate.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bookDate.fields.email') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bookDate.fields.date') }}
                                    </th>
                                    <th>
                                        Operations
                                    </th>
                                    <th>
                                        Book Date
                                    </th>
                                    <th>
                                        Status
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
                                                {{ $student->studentBookDate->date->available_date ?? '' }}
                                            </td>
                                            @if(!empty($student->studentBookDate->book_date_id))
                                            <td>
                                                @can('book_date_show')
                                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.book-dates.show', $student->student_id) }}">
                                                        {{ trans('global.view') }}
                                                    </a>
                                                @endcan

                                                @can('book_date_edit')
                                                    <a class="btn btn-xs btn-info" href="{{ route('admin.book-dates.edit', $student->student_id) }}">
                                                        {{ trans('global.edit') }}
                                                    </a>
                                                @endcan

                                                @can('book_date_delete')
                                                    <form action="{{ route('admin.book-dates.destroy', $student->student_id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                    </form>
                                                @endcan

                                            </td>
                                            @else
                                                <td>
                                                    &nbsp;
                                                </td>
                                            @endif
                                            @if(empty($student->studentBookDate->book_date_id))
                                            <td>
                                                @can('book_date_create')
                                                    <div style="margin-bottom: 10px;" class="row">
                                                        <div class="col-lg-12">
                                                            <form action="{{ route('admin.book-dates.create',$student->student_id) }}">
                                                                @csrf
                                                                {{-- <input type="hidden" name="student_id" value="{{$student->student_id}}"> --}}
                                                                <button type="submit" class="btn btn-success">
                                                                    {{ trans('global.add') }} {{ trans('cruds.bookDate.title_singular') }}
                                                                </button> 
                                                            </form>
                                                        </div>
                                                    </div>
                                                @endcan
                                            </td>
                                            @else
                                            <td>
                                                &nbsp;
                                            </td>
                                            @endif
                                            @if(!empty($student->studentBookDate->book_date_id))
                                            <td>
                                                @can('book_date_status')
                                                    @if(!empty($student->studentBookDate->payment->status))
                                                        <span>{{$student->studentBookDate->payment->status}}</span>
                                                    @else
                                                        <span>{{$student->status}}</span>
                                                    @endif
                                                    <a class="btn btn-xs btn-info" href="{{ route('admin.payments.create', $student->studentBookDate->book_date_id) }}">
                                                        {{ trans('global.edit') }}
                                                    </a>
                                                @endcan
                                            </td>
                                            @else
                                            <td>
                                                &nbsp;
                                            </td>
                                            @endif
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
@can('book_date_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.book-dates.massDestroy') }}",
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
  $('.datatable-BookDate:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection