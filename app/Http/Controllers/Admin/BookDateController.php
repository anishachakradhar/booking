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

        $students = Student::all();

        // dd($students->toArray());

        return view('admin.bookDates.index', compact('students'));
    }

    public function create(StudentExistRequest $request, $id)
    {
        abort_if(Gate::denies('book_date_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $student_id = $id;

        $dates = AvailableDate::all()->pluck('available_date', 'available_date_id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.bookDates.create', compact(['dates', 'student_id']));
    }

    public function store(StoreBookDateRequest $request, $id)
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

        return redirect()->route('admin.book-dates.index');
    }

    public function edit(BookDate $bookDate, $id)
    {
        abort_if(Gate::denies('book_date_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dates = AvailableDate::all()->pluck('available_date', 'available_date_id')->prepend(trans('global.pleaseSelect'), '');

        $bookDate->load('student', 'date');

        $bookDateId = BookDate::where('student_id',$id)->first();

        return view('admin.bookDates.edit', compact('dates', 'bookDate','bookDateId'));
    }

    public function update(UpdateBookDateRequest $request, $id)
    {
        $bookDate = BookDate::where('book_date_id',$id)->first();
        $bookDate->update([
            'available_date_id' => $request->available_date_id,
        ]);

        return redirect()->route('admin.book-dates.index');
    }

    public function show(BookDate $bookDate, $id)
    {
        abort_if(Gate::denies('book_date_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bookDate->load('student', 'date');

        $student = Student::where('student_id',$id)->first();

        return view('admin.bookDates.show', compact('bookDate','student'));
    }

    public function destroy(BookDate $bookDate, $id)
    {
        abort_if(Gate::denies('book_date_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $bookDate = BookDate::where('student_id',$id)->first();
        $payment = Payment::where('book_date_id',$bookDate->payment->book_date_id)->first();
        $bookDateData = $bookDate->delete();
        if($bookDateData == true)
        {
            $payment->delete();
        }

        return back();
    }

    public function massDestroy(MassDestroyBookDateRequest $request)
    {
        BookDate::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
