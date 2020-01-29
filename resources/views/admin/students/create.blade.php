@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.student.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.students.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label class="required" for="name">{{ trans('cruds.student.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                            @if($errors->has('name'))
                                <span class="help-block" role="alert">{{ $errors->first('name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.student.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label class="required" for="email">{{ trans('cruds.student.fields.email') }}</label>
                            <input class="form-control" type="text" name="email" id="email" value="{{ old('email') }}" required>
                            @if($errors->has('email'))
                                <span class="help-block" role="alert">{{ $errors->first('email') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.student.fields.email_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                            <label class="required" for="phone">{{ trans('cruds.student.fields.phone') }}</label>
                            <input class="form-control" type="number" name="phone" id="phone" value="{{ old('phone') }}" step="1" required>
                            @if($errors->has('phone'))
                                <span class="help-block" role="alert">{{ $errors->first('phone') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.student.fields.phone_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                            <label class="required" for="address">{{ trans('cruds.student.fields.address') }}</label>
                            <input class="form-control" type="text" name="address" id="address" value="{{ old('address', '') }}" required>
                            @if($errors->has('address'))
                                <span class="help-block" role="alert">{{ $errors->first('address') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.student.fields.address_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('dob') ? 'has-error' : '' }}">
                            <label class="required" for="dob">{{ trans('cruds.student.fields.dob') }}</label>
                            <input class="form-control date" type="text" name="dob" id="dob" value="{{ old('dob') }}" required>
                            @if($errors->has('dob'))
                                <span class="help-block" role="alert">{{ $errors->first('dob') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.student.fields.dob_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('passport_number') ? 'has-error' : '' }}">
                            <label class="required" for="passport_number">{{ trans('cruds.student.fields.passport_number') }}</label>
                            <input class="form-control" type="number" name="passport_number" id="passport_number" value="{{ old('passport_number') }}" step="1" required>
                            @if($errors->has('passport_number'))
                                <span class="help-block" role="alert">{{ $errors->first('passport_number') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.student.fields.passport_number_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('passport_photo') ? 'has-error' : '' }}">
                            <label class="required" for="passport_photo">{{ trans('cruds.student.fields.passport_photo') }}</label>
                            <div class="needsclick dropzone" id="passport_photo-dropzone">
                            </div>
                            @if($errors->has('passport_photo'))
                                <span class="help-block" role="alert">{{ $errors->first('passport_photo') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.student.fields.passport_photo_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('conductor') ? 'has-error' : '' }}">
                            <label class="required" for="conductor_id">{{ trans('cruds.student.fields.conductor') }}</label>
                            <select class="form-control select2" name="conductor_id" id="conductor_id" required>
                                @foreach($conductors as $conductor_id => $conductor)
                                    <option value="{{ $conductor_id }}" {{ old('conductor_id') == $conductor_id ? 'selected' : '' }}>{{ $conductor }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('conductor_id'))
                                <span class="help-block" role="alert">{{ $errors->first('conductor_id') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.student.fields.conductor_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('module') ? 'has-error' : '' }}">
                            <label class="required" for="module_id">{{ trans('cruds.student.fields.module') }}</label>
                            <select class="form-control select2" name="module_id" id="module_id" required>
                                @foreach($modules as $module_id => $module)
                                    <option value="{{ $module_id }}" {{ old('module_id') == $module_id ? 'selected' : '' }}>{{ $module }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('module_id'))
                                <span class="help-block" role="alert">{{ $errors->first('module_id') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.student.fields.module_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('location') ? 'has-error' : '' }}">
                            <label class="required" for="location_id">{{ trans('cruds.student.fields.location') }}</label>
                            <select class="form-control select2" name="location_id" id="location_id" required>
                                @foreach($locations as $location_id => $location)
                                    <option value="{{ $location_id }}" {{ old('location_id') == $location_id ? 'selected' : '' }}>{{ $location }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('location_id'))
                                <span class="help-block" role="alert">{{ $errors->first('location_id') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.student.fields.location_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.passportPhotoDropzone = {
    url: '{{ route('admin.students.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="passport_photo"]').remove()
      $('form').append('<input type="hidden" name="passport_photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="passport_photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($student) && $student->passport_photo)
      var file = {!! json_encode($student->passport_photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, '{{ $student->passport_photo->getUrl('thumb') }}')
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="passport_photo" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
@endsection