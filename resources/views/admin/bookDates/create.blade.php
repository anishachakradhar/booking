@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.bookDate.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.book-dates.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('date') ? 'has-error' : '' }}">
                            <label class="required" for="date_id">{{ trans('cruds.bookDate.fields.date') }}</label>
                            <select class="form-control select2" name="date_id" id="date_id" required>
                                @foreach($dates as $id => $date)
                                    <option value="{{ $id }}" {{ old('date_id') == $id ? 'selected' : '' }}>{{ $date }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('date_id'))
                                <span class="help-block" role="alert">{{ $errors->first('date_id') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.bookDate.fields.date_helper') }}</span>
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