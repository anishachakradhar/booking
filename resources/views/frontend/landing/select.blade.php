@extends('layouts.frontend')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Select an option
                </div>
                <div class="panel-body">
                    <a class="btn btn-status" href="{{ route('student.date-booking')}}">Book Date</a>
                    <a class="btn btn-grey" href="{{ route('student.details')}}">View Details</a>
                    <a class="btn btn-lightgrey" href="{{route('student.make-payment')}}">Make Payment</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection