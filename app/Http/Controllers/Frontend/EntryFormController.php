<?php

namespace App\Http\Controllers\Frontend;

use App\Module;
use App\Payment;
use App\Student;
use App\BookDate;
use App\Location;
use App\Conductor;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\MediaLibrary\Models\Media;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;

class EntryFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $book_date_id = $id;
        $locations = Location::all()->pluck('location', 'location_id')->prepend(trans('global.pleaseSelect'), '');
        $modules = Module::all()->pluck('module', 'module_id')->prepend(trans('global.pleaseSelect'), '');
        $conductors = Conductor::all()->pluck('conductor', 'conductor_id')->prepend(trans('global.pleaseSelect'), '');
        return view('frontend.student.entry-form', compact('locations','modules','conductors','book_date_id'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentRequest $request, $id)
    {
        $bookDate = BookDate::where('book_date_id', $id)->first();
        $request['student_id'] = Str::random(5);
        $request['book_date_status'] = $bookDate->book_date_status;

        $student = Student::create($request->all());

        if ($request->input('passport_photo', false)) {
            $student->addMedia(storage_path('tmp/uploads/' . $request->input('passport_photo')))->toMediaCollection('passport_photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $student->id]);
        }

        return redirect()->route('student.date-payment', $student->book_date_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $student = Student::where('student_id',$id)->first();
        // $locations = Location::all()->pluck('location', 'location_id')->prepend(trans('global.pleaseSelect'), '');
        // $modules = Module::all()->pluck('module', 'module_id')->prepend(trans('global.pleaseSelect'), '');
        // $conductors = Conductor::all()->pluck('conductor', 'conductor_id')->prepend(trans('global.pleaseSelect'), '');

        // return view('frontend.student.entry-form', compact('locations', 'modules', 'conductors', 'student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $student = Student::where('student_id',$id)->first();

        // $student->update($request->all());

        // if ($request->input('passport_photo', false)) {
        //     if (!$student->passport_photo || $request->input('passport_photo') !== $student->passport_photo->file_name) {
        //         $student->addMedia(storage_path('tmp/uploads/' . $request->input('passport_photo')))->toMediaCollection('passport_photo');
        //     }
        // } elseif ($student->passport_photo) {
        //     $student->passport_photo->delete();
        // }

        // return redirect()->route('student.date-booking', $student->student_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function details(){
        return view('frontend.student.details');
    }

    public function studentDetail(Request $request)
    {
        $studentDetail = Student::where('book_date_id',$request->booking_code)->first();
        if(!empty($studentDetail))
        {
            return view('frontend.student.student-detail',compact('studentDetail'));
        }
        else
        {
            return redirect()->route('student.details')->withError('Booking code invalid.');
        }
    }
}
