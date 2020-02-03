<?php

namespace App\Http\Controllers\Frontend;

use App\Payment;
use App\BookDate;
use App\AvailableDate;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentExistRequest;
use App\Http\Requests\StoreBookDateRequest;

class DateBookingController extends Controller
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
    public function create(Request $request, $id)
    {
        $student_id = $id;
        $dates = AvailableDate::all();
        return view('frontend.student.date-booking', compact('student_id','dates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $bookDate = BookDate::create([
            'book_date_id' => Str::random(5),
            'available_date_id' => $request->available_date_id,
            'student_id' => $id,
        ]);

        $payment = Payment::create([
            'status' => $bookDate->student->status,
            'payment_id' => Str::random(5),
            'book_date_id' => $bookDate->book_date_id,
        ]);

        if(!empty($bookDate))
        {
            $availableDate = AvailableDate::where('available_date_id',$bookDate->available_date_id)->first();
            $count = $availableDate->available_seat;
            if($count > 0)
            {   
                $count--;
                $availableDate->update([
                    'available_seat' => $count,
                ]);
                if($count == 0)
                {
                    $availableDate->update([
                        'available_date_status' => 'not_available',
                    ]);
                }
            }
        }

        return redirect()->route('student.date-payment', $bookDate->student_id);
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
}
