@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.bookDate.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.book-dates.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bookDate.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $bookDate->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Date Booked
                                    </th>
                                    <td>
                                        {{ $bookDate->date->available_date ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Payment Status
                                    </th>
                                    <td>
                                        @if($bookDate->payment_status == 'unpaid')
                                            <span>Unpaid</span>
                                        @elseif($bookDate->payment_status == 'paid')
                                            <span>Paid</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Date Booked Status
                                    </th>
                                    <td>
                                        {{ $bookDate->status_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Temporary Booking Code
                                    </th>
                                    <td>
                                        {{ $bookDate->temp_booking_code }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Permanent Booking Code
                                    </th>
                                    <td>
                                        {{ $bookDate->permanent_booking_code }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.book-dates.index') }}">
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