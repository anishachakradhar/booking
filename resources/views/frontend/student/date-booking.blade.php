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
                    <form method="POST" action="{{ route("student.date-booking.store", $student_id)}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{$student_id}}" name="student_id">
                        <div class="form-group {{ $errors->has('date') ? 'has-error' : '' }}">
                            <label class="required" for="available_date_id">{{ trans('cruds.bookDate.fields.date') }}</label>
                            <select class="form-control select2" name="available_date_id" id="available_date_id" required>
                                @foreach($dates as $date)
                                    @if($date->available_date_status == 'active')
                                        <option value="{{ $date->available_date_id }}" {{ old('available_date_id') == $date->available_date_id ? 'selected' : '' }}>{{ $date->available_date }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @if($errors->has('available_date_id'))
                                <span class="help-block" role="alert">{{ $errors->first('available_date_id') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.bookDate.fields.date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <a class="btn btn-blue" type="submit" href="{{ route('student.entry-form.edit', $student_id)}}">
                                Back
                            </a>
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