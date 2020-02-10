@extends('layouts.frontend')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Enter your booking code
                </div>
                <div class="panel-body">
                    <form action="{{ route('student.student-detail')}}" method="GET">
                        @csrf
                        <div class="form-group">
                            <label for="permanent_booking_code">Booking Code</label>
                            <input class="form-control" type="number" name="permanent_booking_code" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection