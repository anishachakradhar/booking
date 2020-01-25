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
                    <form method="POST" action="{{ route("admin.payments.store", $book_date->book_date_id)}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                            <label class="required" for="status">Status</label>
                            <select class="form-control" name="status" id="status" required>
                                @if(!empty($book_date->payment->book_date_id))
                                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                    @foreach(App\Student::STATUS_SELECT as $key => $label)
                                        <option value="{{ $key }}" {{ old('status', $book_date->payment->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                @else
                                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                    @foreach(App\Student::STATUS_SELECT as $key => $label)
                                        <option value="{{ $key }}" {{ old('status', $book_date->student->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                @endif
                            </select>
                            {{-- @if($errors->has('payment'))
                                <span class="help-block" role="alert">{{ $errors->first('payment') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.payment.fields.date_helper') }}</span> --}}
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