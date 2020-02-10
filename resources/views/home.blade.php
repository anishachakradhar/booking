@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Dashboard
                </div>

                <div class="panel-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-3">
                <div class="panel panel-default count">
                    <div class="panel-heading count-heading">
                        Total Applicants
                    </div>

                    <div class="panel-body count-body">
                        <a class="stretched-link" href="{{ route('admin.students.index')}}">{{ $totalCount }}</a>
                    </div>
                </div>
            </div>
            @if(!empty($singleCount['pending']))
                <div class="col-lg-3">
                    <div class="panel panel-default count">
                        <div class="panel-heading count-heading">
                            Pending Booking 
                        </div>

                        <div class="panel-body count-body">
                            <a class="stretched-link" href="{{ route('admin.excel-reports.pending')}}">{{ $singleCount['pending'] }}</a>
                        </div>
                    </div>
                </div>
            @endif
            @if(!empty($singleCount['approved']))
                <div class="col-lg-3">
                    <div class="panel panel-default count">
                        <div class="panel-heading count-heading">
                            Approved Booking 
                        </div>

                        <div class="panel-body count-body">
                            <a class="stretched-link" href="{{ route('admin.excel-reports.approved')}}">{{ $singleCount['approved'] }}</a>
                        </div>
                    </div>
                </div>
            @endif
            @if(!empty($singleCount['awaiting_consultancy_confirmation']))
                <div class="col-lg-3">
                    <div class="panel panel-default count">
                        <div class="panel-heading count-heading">
                            Awaiting Consultancy Confirmation
                        </div>

                        <div class="panel-body count-body">
                            {{ $singleCount['awaiting_consultancy_confirmation'] }}
                        </div>
                    </div>
                </div>
            @endif
            @if(!empty($singleCount['awaiting_date_booking']))
                <div class="col-lg-3">
                    <div class="panel panel-default count">
                        <div class="panel-heading count-heading">
                            Awaiting Date Booking
                        </div>

                        <div class="panel-body count-body">
                            {{ $singleCount['awaiting_date_booking'] }}
                        </div>
                    </div>
                </div>
            @endif
            @if(!empty($singleCount['changed_date']))
                <div class="col-lg-3">
                    <div class="panel panel-default count">
                        <div class="panel-heading count-heading">
                            Changed Date
                        </div>

                        <div class="panel-body count-body">
                            {{ $singleCount['changed_date'] }}
                        </div>
                    </div>
                </div>
            @endif
            @if(!empty($singleCount['date_booked']))
                <div class="col-lg-3">
                    <div class="panel panel-default count">
                        <div class="panel-heading count-heading">
                            Date Booked
                        </div>

                        <div class="panel-body count-body">
                            {{ $singleCount['date_booked'] }}
                        </div>
                    </div>
                </div>
            @endif
            @if(!empty($singleCount['booking_held']))
                <div class="col-lg-3">
                    <div class="panel panel-default count">
                        <div class="panel-heading count-heading">
                            Booking Held
                        </div>

                        <div class="panel-body count-body">
                            {{ $singleCount['booking_held'] }}
                        </div>
                    </div>
                </div>
            @endif
            @if(!empty($singleCount['awaiting_refund']))
                <div class="col-lg-3">
                    <div class="panel panel-default count">
                        <div class="panel-heading count-heading">
                            Awaiting Refund
                        </div>

                        <div class="panel-body count-body">
                            {{ $singleCount['awaiting_refund'] }}
                        </div>
                    </div>
                </div>
            @endif
            @if(!empty($singleCount['refunded']))
                <div class="col-lg-3">
                    <div class="panel panel-default count">
                        <div class="panel-heading count-heading">
                            Refunded
                        </div>

                        <div class="panel-body count-body">
                            {{ $singleCount['refunded'] }}
                        </div>
                    </div>
                </div>
            @endif
            @if(!empty($singleCount['processing_refund']))
                <div class="col-lg-3">
                    <div class="panel panel-default count">
                        <div class="panel-heading count-heading">
                            Processing Refund
                        </div>

                        <div class="panel-body count-body">
                            {{ $singleCount['processing_refund'] }}
                        </div>
                    </div>
                </div>
            @endif
            @if(!empty($singleCount['cancelled']))
                <div class="col-lg-3">
                    <div class="panel panel-default count">
                        <div class="panel-heading count-heading">
                            Cancelled
                        </div>

                        <div class="panel-body count-body">
                            {{ $singleCount['cancelled'] }}
                        </div>
                    </div>
                </div>
            @endif  
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent

@endsection