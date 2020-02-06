@extends('layouts.frontend')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @if(empty($payment_success))
                        <div>Sorry !</div>
                    @else
                        <div>Thank You !</div>
                    @endif
                </div>
                <div class="panel-body">
                    @if(empty($payment_success))
                        <div>Payment Unsuccessful.</div>
                    @else
                        <div>Payment Successful.</div>
                    @endif
                </div>
            </div>
            <div> 
                <a href="{{ route('student.landing.home')}}" class="btn btn-primary">Home</a>
            </div>
        </div>
        
    </div>
</div>
@endsection