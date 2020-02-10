<?php

namespace App\Http\Controllers\Frontend;

use App\Payment;
use App\Student;
use App\BookDate;
use App\AvailableDate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

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
        $book_date = BookDate::where('book_date_id',$id)->first();   

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
        $args = http_build_query(array(
            'token' => $request->token, 
            'amount'  => $request->amount 
        ));
        // dump($request->toArray());

        $url = "https://khalti.com/api/v2/payment/verify/";

        # Make the call using API.
        try {
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
            
            if($status_code != 200)
            {
                return response()->json([
                    'success'=> false,
                    'message'=> $res,
                ], 200);
            }

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
                'token'         =>  $request->token,
            ]);

            return response()->json([
                'success'=> true,
                'message'=> 'paid',
                'booking_code'=> $payment->bookDatePayment->permanent_booking_code,
            ], 200);
            
        } catch (\Throwable $th) {
            return response()->json([
                'success'=> false,
                'message'=> $th->getMessage(),
            ], 200);
        }
        

    }

    public function paymentResult($id)
    {
        $payment_success = Payment::where('book_date_id',$id)->first();
        if(!empty($payment_success))
        {
            $availableDate = AvailableDate::where('available_date_id',$payment_success->bookDatePayment->date->available_date_id)->first();
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

            $bookDate = BookDate::where('book_date_id',$payment_success->book_date_id)->first();

            $bookDate->update([
                'payment_status' => 'paid',
                'permanent_booking_code'  =>  Session::get('permanent_booking_code'),
            ]);

            return view('frontend.datePayment.payment-result')->with('payment_success',$payment_success);
        }

        return view('frontend.datePayment.payment-result');
        
    }

    public function makePayment()
    {
        return view('frontend.datePayment.make-payment');
    }

    public function directPayment(Request $request)
    {
        Session::put('permanent_booking_code', $this->generateBookingCode());
        $datePayment = BookDate::where('temp_booking_code',$request->temp_booking_code)->first();
        if(!empty($datePayment)  && !empty($datePayment->student))
        {
            if($datePayment->payment_status == 'unpaid')
            {
                return redirect()->route('student.date-payment',$datePayment->book_date_id);
            }
            else
            {
                return redirect()->route('student.make-payment')->withError('Payment Already done.');
            }
        }
        elseif(!empty($datePayment) && empty($datePayment->student->student_id))
        {
            return redirect()->route('student.make-payment')->withError('Student form not filled.');
        }
        else
        {
            return redirect()->route('student.make-payment')->withError('Invalid temporary booking code.');
        }
    }
    public function generateBookingCode() {
        $number = mt_rand(100000, 999999); 
    
        // call the same function if the barcode exists already
        if ($this->bookingCode($number)) {
            return generateBookingCode();
        }
    
        // otherwise, it's valid and can be used
        return $number;
    }

    public function bookingCode($number)
    {
        return BookDate::wherePermanentBookingCode($number)->exists();
    }

}
