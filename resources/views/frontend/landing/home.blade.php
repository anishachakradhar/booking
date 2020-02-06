@extends('layouts.frontend')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Select course
                </div>
                <div class="panel-body">
                    <a class="btn btn-success" href="{{ route('student.ielts')}}">IELTS</a>
                    <a class="btn btn-orange" href="#">PTE</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection