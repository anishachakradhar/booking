@extends('layouts.admin')
@section('content')
<div class="content">
    @can('available_date_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.available-dates.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.availableDate.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.availableDate.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-AvailableDate">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.availableDate.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.availableDate.fields.available_date') }}
                                    </th>
                                    <th>
                                        Available Seat
                                    </th>
                                    <th>
                                        Available Date Status
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($availableDates as $key => $availableDate)
                                    <tr data-entry-id="{{ $availableDate->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            {{ $availableDate->available_date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $availableDate->available_seat ?? '' }}
                                        </td>
                                        <td>
                                            @if($availableDate->available_date_status == 'active')
                                            <a class="btn btn-xs btn-success">
                                                Active
                                            </a>                                            
                                            @elseif($availableDate->available_date_status == 'disabled')
                                            <a class="btn btn-xs btn-orange">
                                                Disabled
                                            </a>                                            
                                            @elseif($availableDate->available_date_status == 'not_available')
                                            <a class="btn btn-xs btn-grey">
                                                Not Available
                                            </a>                                            
                                            @endif
                                        </td>
                                        <td>
                                            @can('available_date_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.available-dates.show', $availableDate->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('available_date_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.available-dates.edit', $availableDate->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('available_date_delete')
                                                <form action="{{ route('admin.available-dates.destroy', $availableDate->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                </form>
                                            @endcan

                                            @can('available_date_status')
                                                @if($availableDate->available_date_status == 'active')
                                                    <a class="btn btn-xs btn-status" href="{{ route('admin.available-dates.status', $availableDate->id) }}">
                                                        Disable
                                                    </a>
                                                @elseif($availableDate->available_date_status == 'disabled')
                                                    <a class="btn btn-xs btn-status" href="{{ route('admin.available-dates.status', $availableDate->id) }}">
                                                        Activate
                                                    </a>
                                                {{-- @elseif($availableDate->available_date_status == 'not_available')
                                                    <a class="btn btn-xs btn-status">
                                                        Not Available
                                                    </a> --}}
                                                @endif
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
@can('available_date_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.available-dates.massDestroy') }}",
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
  $('.datatable-AvailableDate:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection