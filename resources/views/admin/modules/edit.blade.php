@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.module.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.modules.update", [$module->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('module') ? 'has-error' : '' }}">
                            <label for="module">{{ trans('cruds.module.fields.module') }}</label>
                            <input class="form-control" type="text" name="module" id="module" value="{{ old('module', $module->module) }}">
                            @if($errors->has('module'))
                                <span class="help-block" role="alert">{{ $errors->first('module') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.module.fields.module_helper') }}</span>
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