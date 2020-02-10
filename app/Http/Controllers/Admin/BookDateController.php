<?php

namespace App\Http\Controllers\Admin;

use Gate;
use App\Payment;
use App\Student;
use App\BookDate;
use App\AvailableDate;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\StudentExistRequest;
use App\Http\Requests\StoreBookDateRequest;
use App\Http\Requests\UpdateBookDateRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\MassDestroyBookDateRequest;

class BookDateController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('book_date_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bookDates = BookDate::all();
    
        return view('admin.bookDates.index', compact('bookDates'));
    }

    public function create(StudentExistRequest $request)
    {
        abort_if(Gate::denies('book_date_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $dates = AvailableDate::where('available_date_status','active')->pluck( 'available_date','available_date_id')->prepend(trans('global.pleaseSelect'), '');
        return view('admin.bookDates.create', compact('dates'));
    }

    public function store(StoreBookDateRequest $request)
    {
        
        $bookDate = BookDate::create([
            'book_date_id' => Str::random(5),
            'available_date_id' => $request->available_date_id,
            'temp_booking_code' => $this->generateTempBookingCode()
        ]);

        return redirect()->route('admin.book-dates.index');
    }

    public function edit(BookDate $bookDate, $id)
    {
        abort_if(Gate::denies('book_date_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $dates = AvailableDate::where('available_date_status','active')->pluck( 'available_date','available_date_id')->prepend(trans('global.pleaseSelect'), '');

        $bookDateId = BookDate::where('book_date_id',$id)->first();

        return view('admin.bookDates.edit', compact('bookDateId','dates'));
    }

    public function update(UpdateBookDateRequest $request, $id)
    {
        $bookDate = BookDate::where('book_date_id',$id)->first();
        $bookDate->update([
            'available_date_id' => $request->available_date_id,
        ]);

        // $paymentStatus = Payment::where('book_date_id',$bookDate->book_date_id)->first();
        // $studentStatus = Student::where('student_id',$paymentStatus->bookDatePayment->student->student_id)->first();

        // if($studentStatus->status == 'approved')
        // {
        //     $paymentStatus->update([
        //         'status' => 'changed_date',
        //     ]);
        //     $studentStatus->update([
        //         'status' => 'changed_date',
        //     ]);
        // }

        return redirect()->route('admin.book-dates.index');
    }

    public function show(BookDate $bookDate, $id)
    {
        abort_if(Gate::denies('book_date_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bookDate = BookDate::where('book_date_id',$id)->first();

        return view('admin.bookDates.show', compact('bookDate'));
    }

    public function destroy(BookDate $bookDate, $id)
    {
        abort_if(Gate::denies('book_date_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $bookDate = BookDate::where('book_date_id',$id)->first();
        // $payment = Payment::where('book_date_id',$bookDate->payment->book_date_id)->first();
        $bookDateData = $bookDate->delete();
        // if($bookDateData == true)
        // {
        //     $payment->delete();
        // }

        return back();
    }

    public function massDestroy(MassDestroyBookDateRequest $request)
    {
        BookDate::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
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
