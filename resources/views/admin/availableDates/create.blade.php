@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.availableDate.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.available-dates.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('available_date') ? 'has-error' : '' }}">
                            <label for="available_date">{{ trans('cruds.availableDate.fields.available_date') }}</label>
                            <input class="form-control date" type="text" name="available_date" id="available_date" value="{{ old('available_date') }}">
                            @if($errors->has('available_date'))
                                <span class="help-block" role="alert">{{ $errors->first('available_date') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.availableDate.fields.available_date_helper') }}</span>
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