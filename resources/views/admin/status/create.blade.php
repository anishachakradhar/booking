@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Change status for book-date
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.status.store", $book_date->book_date_id)}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('book_date_status') ? 'has-error' : '' }}">
                            <label class="required" for="book_date_status">Date Booked Status</label>
                            <select class="form-control" name="book_date_status" id="book_date_status" required>
                                @foreach($bookDateStatus as $key => $value)
                                    <option value="{{ $key }}" {{ ($book_date->book_date_status ? $key : old('$key')) == $book_date->book_date_status ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection