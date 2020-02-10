<?php

namespace App\Http\Controllers\Api\V1\Student;

use App\BookDate;
use App\AvailableDate;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\StoreBookDateRequest;
use App\Http\Requests\CheckAvailableDateRequest;
use App\Http\Resources\Frontend\DateBookingCollection;
use App\Http\Resources\Frontend\StoreDateBookingResource;

class ApiDateBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dates = AvailableDate::where('available_date_status','active')->get();

        return response()->json(new DateBookingCollection ($dates),200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckAvailableDateRequest $request)
    {
        $bookDate = BookDate::create([
            'book_date_id' => Str::random(5),
            'available_date_id' => $request->available_date_id,
        ]);
            
        return response()->json([
            'error' => false,
            'message' => 'Fill the student detail form',
            'book_date_id' => $bookDate->book_date_id
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
        // $bookDate = BookDate::where('book_date_id', $id);
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
