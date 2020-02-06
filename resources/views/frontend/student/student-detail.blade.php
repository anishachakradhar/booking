@extends('layouts.frontend')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Student's Detail
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        Name
                                    </th>
                                    <td>
                                        {{ $studentDetail->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Email
                                    </th>
                                    <td>
                                        {{ $studentDetail->email }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Phone number
                                    </th>
                                    <td>
                                        {{ $studentDetail->phone }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Location
                                    </th>
                                    <td>
                                        {{ $studentDetail->location->location }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Date Booked
                                    </th>
                                    <td>
                                        {{ $studentDetail->studentBookDate->date->available_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Date Booked Status
                                    </th>
                                    <td>
                                        {{ $studentDetail->studentBookDate->status_name }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('student.ielts') }}">
                                Okay
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection