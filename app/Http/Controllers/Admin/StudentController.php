<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyStudentRequest;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Location;
use App\Student;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use App\Module;
use App\Conductor;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('student_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $students = Student::all();

        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        abort_if(Gate::denies('student_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $locations = Location::all()->pluck('location', 'location_id')->prepend(trans('global.pleaseSelect'), '');
        $modules = Module::all()->pluck('module', 'module_id')->prepend(trans('global.pleaseSelect'), '');
        $conductors = Conductor::all()->pluck('conductor', 'conductor_id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.students.create', compact('locations','modules','conductors'));
    }

    public function store(StoreStudentRequest $request)
    {
        $request['student_id'] = Str::random(5);
        $student = Student::create($request->all());

        if ($request->input('passport_photo', false)) {
            $student->addMedia(storage_path('tmp/uploads/' . $request->input('passport_photo')))->toMediaCollection('passport_photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $student->id]);
        }

        return redirect()->route('admin.students.index');
    }

    public function edit(Student $student)
    {
        abort_if(Gate::denies('student_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $locations = Location::all()->pluck('location', 'location_id')->prepend(trans('global.pleaseSelect'), '');
        $modules = Module::all()->pluck('module', 'module_id')->prepend(trans('global.pleaseSelect'), '');
        $conductors = Conductor::all()->pluck('conductor', 'conductor_id')->prepend(trans('global.pleaseSelect'), '');


        $student->load('location');

        return view('admin.students.edit', compact('locations', 'modules', 'conductors', 'student'));
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student->update($request->all());

        if ($request->input('passport_photo', false)) {
            if (!$student->passport_photo || $request->input('passport_photo') !== $student->passport_photo->file_name) {
                $student->addMedia(storage_path('tmp/uploads/' . $request->input('passport_photo')))->toMediaCollection('passport_photo');
            }
        } elseif ($student->passport_photo) {
            $student->passport_photo->delete();
        }

        return redirect()->route('admin.students.index');
    }

    public function show(Student $student)
    {
        abort_if(Gate::denies('student_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $student->load('location', 'module', 'conductor');
        // $student->load('location', 'module', 'conductor', 'nameExcelReports', 'emailExcelReports', 'phoneExcelReports', 'dobExcelReports', 'studentsEmailBookDates', 'addressExcelReports', 'consultancyNameExcelReports', 'locationExcelReports', 'conductorExcelReports', 'moduleExcelReports');

        return view('admin.students.show', compact('student'));
    }

    public function destroy(Student $student)
    {
        abort_if(Gate::denies('student_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $student->delete();

        return back();
    }

    public function massDestroy(MassDestroyStudentRequest $request)
    {
        Student::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('student_create') && Gate::denies('student_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Student();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media', 'public');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
