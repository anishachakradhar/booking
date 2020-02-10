@extends('layouts.frontend')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Enter your temporary booking code
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route('student.date-payment.direct')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('temp_booking_code') ? 'has-error' : '' }}">
                            <label class="required" for="email">Temporary Booking Code</label>
                            <input class="form-control" type="number" name="temp_booking_code" required>
                            <span class="help-block">Please enter your temporary booking code.</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection