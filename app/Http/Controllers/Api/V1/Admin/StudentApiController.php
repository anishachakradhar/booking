<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Resources\Admin\StudentResource;
use App\Student;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('student_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StudentResource(Student::with(['location'])->get());
    }

    public function store(StoreStudentRequest $request)
    {
        $student = Student::create($request->all());

        if ($request->input('passport_photo', false)) {
            $student->addMedia(storage_path('tmp/uploads/' . $request->input('passport_photo')))->toMediaCollection('passport_photo');
        }

        return (new StudentResource($student))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Student $student)
    {
        abort_if(Gate::denies('student_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StudentResource($student->load(['location']));
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

        return (new StudentResource($student))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Student $student)
    {
        abort_if(Gate::denies('student_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $student->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
