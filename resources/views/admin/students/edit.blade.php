@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.student.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.students.update", [$student->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label class="required" for="name">{{ trans('cruds.student.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $student->name) }}" required>
                            @if($errors->has('name'))
                                <span class="help-block" role="alert">{{ $errors->first('name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.student.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label class="required" for="email">{{ trans('cruds.student.fields.email') }}</label>
                            <input class="form-control" type="text" name="email" id="email" value="{{ old('email', $student->email) }}" required>
                            @if($errors->has('email'))
                                <span class="help-block" role="alert">{{ $errors->first('email') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.student.fields.email_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                            <label class="required" for="phone">{{ trans('cruds.student.fields.phone') }}</label>
                            <input class="form-control" type="number" name="phone" id="phone" value="{{ old('phone', $student->phone) }}" step="1" required>
                            @if($errors->has('phone'))
                                <span class="help-block" role="alert">{{ $errors->first('phone') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.student.fields.phone_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                            <label class="required" for="address">{{ trans('cruds.student.fields.address') }}</label>
                            <input class="form-control" type="text" name="address" id="address" value="{{ old('address', $student->address) }}" required>
                            @if($errors->has('address'))
                                <span class="help-block" role="alert">{{ $errors->first('address') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.student.fields.address_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('dob') ? 'has-error' : '' }}">
                            <label class="required" for="dob">{{ trans('cruds.student.fields.dob') }}</label>
                            <input class="form-control date" type="text" name="dob" id="dob" value="{{ old('dob', $student->dob) }}" required>
                            @if($errors->has('dob'))
                                <span class="help-block" role="alert">{{ $errors->first('dob') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.student.fields.dob_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('consultancy_name') ? 'has-error' : '' }}">
                            <label for="consultancy_name">{{ trans('cruds.student.fields.consultancy_name') }}</label>
                            <input class="form-control" type="text" name="consultancy_name" id="consultancy_name" value="{{ old('consultancy_name', $student->consultancy_name) }}">
                            @if($errors->has('consultancy_name'))
                                <span class="help-block" role="alert">{{ $errors->first('consultancy_name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.student.fields.consultancy_name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('passport_number') ? 'has-error' : '' }}">
                            <label class="required" for="passport_number">{{ trans('cruds.student.fields.passport_number') }}</label>
                            <input class="form-control" type="number" name="passport_number" id="passport_number" value="{{ old('passport_number', $student->passport_number) }}" step="1" required>
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
                            <label class="required">{{ trans('cruds.student.fields.conductor') }}</label>
                            <select class="form-control" name="conductor" id="conductor" required>
                                <option value disabled {{ old('conductor', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Student::CONDUCTOR_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('conductor', $student->conductor) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('conductor'))
                                <span class="help-block" role="alert">{{ $errors->first('conductor') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.student.fields.conductor_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('module') ? 'has-error' : '' }}">
                            <label class="required">{{ trans('cruds.student.fields.module') }}</label>
                            <select class="form-control" name="module" id="module" required>
                                <option value disabled {{ old('module', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Student::MODULE_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('module', $student->module) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('module'))
                                <span class="help-block" role="alert">{{ $errors->first('module') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.student.fields.module_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('location') ? 'has-error' : '' }}">
                            <label class="required" for="location_id">{{ trans('cruds.student.fields.location') }}</label>
                            <select class="form-control select2" name="location_id" id="location_id" required>
                                @foreach($locations as $id => $location)
                                    <option value="{{ $id }}" {{ ($student->location ? $student->location->id : old('location_id')) == $id ? 'selected' : '' }}>{{ $location }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('location_id'))
                                <span class="help-block" role="alert">{{ $errors->first('location_id') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.student.fields.location_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                            <label class="required">{{ trans('cruds.student.fields.status') }}</label>
                            <select class="form-control" name="status" id="status" required>
                                <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Student::STATUS_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('status', $student->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('status'))
                                <span class="help-block" role="alert">{{ $errors->first('status') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.student.fields.status_helper') }}</span>
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