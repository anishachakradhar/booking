@extends('layouts.frontend')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.bookDate.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route('student.date-booking.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('date') ? 'has-error' : '' }}">
                            <label class="required" for="available_date_id">{{ trans('cruds.bookDate.fields.date') }}</label>
                            <select class="form-control select2" name="available_date_id" id="available_date_id" required>
                                @foreach($dates as $available_date_id => $available_date)
                                    <option value="{{ $available_date_id }}">{{ $available_date }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('available_date_id'))
                                <span class="help-block" role="alert">{{ $errors->first('available_date_id') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.bookDate.fields.date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            @if($dates->count() == 1)
                                <span>No dates available.</span>
                            @endif
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