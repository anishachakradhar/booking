<?php

namespace App\Http\Controllers\Frontend;

use App\Payment;
use App\BookDate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DatePaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('frontend.datePayment.test-payment');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $book_date = BookDate::where('student_id',$id)->first();

        // dd($book_date->toArray());
        
        return view('frontend.datePayment.date-payment',compact('book_date'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function verification(Request $request)
    {
        // dd($request->toArray());
        //req amt == amt 
        // dd($request->toArray());
        $args = http_build_query(array(
            'token' => $request->token, //token send from client integration; Client side payment initiation
            'amount'  => $request->amount //amount should be checked and keep real amount to be paid, 
        ));

        $url = "https://khalti.com/api/v2/payment/verify/";

        # Make the call using API.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $headers = ['Authorization: Key '.env('KHALTI_SECRET_KEY')];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Response
        $response = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $res = json_decode($response, true);

        // dd($res);

        $payment = Payment::create([
            'book_date_id'  =>  $request->product_name,
            'student_id'    =>  $request->product_identity,
            'payment_id'    =>  $res['idx'],
            'type_id'       =>  $res['type']['idx'],
            'type_name'     =>  $res['type']['name'],
            'status_id'     =>  $res['state']['idx'],
            'status_name'   =>  $res['state']['name'],
            'amount'        =>  $res['amount'],
            'fee_amount'    =>  $res['fee_amount'],
            'refund_status' =>  $res['refunded'],
            'user_id'       =>  $res['user']['idx'],
            'user_name'     =>  $res['user']['name'],
            'user_phone'    =>  $res['user']['mobile'],
            'merchant_id'   =>  $res['merchant']['idx'],
            'merchant_name' =>  $res['merchant']['name'],
            'merchant_phone'=>  $res['merchant']['mobile'],
        ]);

        return response()->json([
            'success'=> true,
            'message'=> 'paid'
        ], 200);
        return view('frontend.student.entry-form'); 
    }

    public function test()
    {
        $response = '{"idx":"WMocJGqf6YY5YfD6urjTXj","type":{"idx":"2jwzDS9wkxbkDFquJqfAEC","name":"Wallet payment"},"state":{"idx":"DhvMj9hdRufLqkP8ZY4d8g","name":"Completed","template":"is complete"},"amount":1000,"fee_amount":30,"refunded":false,"created_on":"2020-02-03T15:38:54.318817+05:45","user":{"idx":"znRMopULPNP5vwmaMjkyng","name":"Anisha Chakradhar","mobile":"9843586044"},"merchant":{"idx":"tvtgvYAeynqCj8g475hXrY","name":"Demo","mobile":"sukhadshresthaX13@hotmail.com"}}';

        dd($response);
    }

}
