@extends('layouts.admin')
@section('content')
<div class="content">
    @can('book_date_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <form action="{{ route('admin.book-dates.create') }}">
                    @csrf
                    <button type="submit" class="btn btn-success">
                        {{ trans('global.add') }} {{ trans('cruds.bookDate.title_singular') }}
                    </button> 
                </form>
            </div>
        </div>
    @endcan
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
                                        ID
                                    </th>
                                    <th>
                                        Date Booked
                                    </th>
                                    <th>
                                        Payment Status
                                    </th>
                                    <th>
                                        Date Booked Status
                                    </th>
                                    <th>
                                        Temporary Booking Code
                                    </th>
                                    <th>
                                        Permanent Booking Code
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach($bookDates as $key => $bookDate)
                                        <tr data-entry-id="{{ $bookDate->id }}">
                                            <td>

                                            </td>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $bookDate->date->available_date ?? '' }}
                                            </td>
                                            <td>
                                                @if($bookDate->payment_status == 'unpaid')
                                                    <span>Unpaid</span>
                                                @elseif($bookDate->payment_status == 'paid')
                                                    <span>Paid</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $bookDate->status_name }}
                                            </td>
                                            <td>
                                                {{ $bookDate->temp_booking_code }}
                                            </td>
                                            <td>
                                                {{ $bookDate->permanent_booking_code }}
                                            </td>
                                            <td>
                                                @can('book_date_show')
                                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.book-dates.show', $bookDate->book_date_id) }}">
                                                        {{ trans('global.view') }}
                                                    </a>
                                                @endcan

                                                @can('book_date_edit')
                                                    <a class="btn btn-xs btn-info" href="{{ route('admin.book-dates.edit', $bookDate->book_date_id) }}">
                                                        {{ trans('global.edit') }}
                                                    </a>
                                                @endcan

                                                @can('book_date_delete')
                                                    <form action="{{ route('admin.book-dates.destroy', $bookDate->book_date_id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                    </form>
                                                @endcan

                                            </td>
                                            <td>
                                                @if(empty($bookDate->student))
                                                    @can('student_create')
                                                        <div style="margin-bottom: 10px;" class="row">
                                                            <div class="col-lg-12">
                                                                <a class="btn btn-success" href="{{ route('admin.students.create', $bookDate->book_date_id) }}">
                                                                    Add Student Details
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @endcan
                                                @endif
                                            </td>
                                            {{-- @if(!empty($bookDate->book_date_id))
                                            <td>
                                                @can('book_date_status')
                                                    @if(!empty($bookDate->studentBookDate->payment->status))
                                                        {{ $student->status_name }}
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
                                            @endif --}}
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