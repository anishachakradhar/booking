@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.conductor.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.conductors.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('conductor') ? 'has-error' : '' }}">
                            <label for="conductor">{{ trans('cruds.conductor.fields.conductor') }}</label>
                            <input class="form-control" type="text" name="conductor" id="conductor" value="{{ old('conductor', '') }}">
                            @if($errors->has('conductor'))
                                <span class="help-block" role="alert">{{ $errors->first('conductor') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.conductor.fields.conductor_helper') }}</span>
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