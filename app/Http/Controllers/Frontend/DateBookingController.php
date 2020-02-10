<?php

namespace App\Http\Controllers\Frontend;

use App\Payment;
use App\BookDate;
use App\AvailableDate;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
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
    public function create(Request $request)
    {
        $dates = AvailableDate::where('available_date_status','active')->pluck( 'available_date','available_date_id')->prepend(trans('global.pleaseSelect'), '');
        // dd($dates->toArray());
        return view('frontend.student.date-booking', compact('dates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookDateRequest $request)
    {
        Session::put('available_date_id', $request->available_date_id);
        Session::put('book_date_id', Str::random(5));
        Session::put('temp_booking_code', $this->generateTempBookingCode());
        Session::put('permanent_booking_code', $this->generateBookingCode());

        // $bookDate = BookDate::create([
        //     'book_date_id' => Str::random(5),
        //     'available_date_id' => $request->available_date_id,
        // ]);

        // if(!empty($bookDate))
        // {
        //     $availableDate = AvailableDate::where('available_date_id',$bookDate->available_date_id)->first();
        //     $count = $availableDate->available_seat;
        //     if($count > 0)
        //     {   
        //         $count--;
        //         $availableDate->update([
        //             'available_seat' => $count,
        //         ]);
        //         if($count == 0)
        //         {
        //             $availableDate->update([
        //                 'available_date_status' => 'not_available',
        //             ]);
        //         }
        //     }
        // }

        return redirect()->route('student.entry-form', Session::get('book_date_id'));
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

    public function generateBookingCode() {
        $num = mt_rand(100000, 999999); 
    
        // call the same function if the barcode exists already
        if ($this->bookingCode($num)) {
            return generateBookingCode();
        }
    
        // otherwise, it's valid and can be used
        return $num;
    }

    public function bookingCode($num)
    {
        return BookDate::wherePermanentBookingCode($num)->exists();
    }
}
