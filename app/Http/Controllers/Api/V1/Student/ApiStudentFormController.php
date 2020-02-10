<?php

namespace App\Http\Controllers\Api\V1\Student;

use App\Module;
use App\Student;
use App\BookDate;
use App\Location;
use App\Conductor;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\CheckStudentRequest;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Resources\Frontend\StudentFormCollection;

class ApiStudentFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Location::select('location_id','location')->get();
        $modules = Module::select('module_id','module')->get();
        $conductors = Conductor::select('conductor_id','conductor')->get();

        return response()->json([
            'location' => $locations,
            'modules' => $modules,
            'conductors' => $conductors
        ],200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckStudentRequest $request)
    {
        $bookDate = BookDate::where('book_date_id', $request->book_date_id)->first();
        $request['student_id'] = Str::random(5);
        $request['book_date_status'] = $bookDate->book_date_status;

        $student = Student::create($request->all());

        if(empty($student))
        {
            return response()->json([
                'error'   =>  'true',
                'message'   =>  'Error in student detail form',
            ]);
        }

        $bookDate->update([
            'temp_booking_code' => $this->generateTempBookingCode()
        ]);

        return response()->json([
            'error'   =>  'false',
            'message'   =>  'Make payment for the particular date',
            'student_id'    =>  $student->student_id,
            'book_date_id'  =>  $student->studentBookDate->book_date_id,
            'temp_booking_code' =>  $bookDate->temp_booking_code
        ]);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
    public function generateTempBookingCode() {
        $number = mt_rand(100000, 999999); 
    
        // call the same function if the barcode exists already
        if ($this->tempBookingCode($number)) {
            return generateTempBookingCode();
        }
    
        // otherwise, it's valid and can be used
        return $number;
    }

    public function tempBookingCode($number)
    {
        return BookDate::whereTempBookingCode($number)->exists();
    }
    
}
