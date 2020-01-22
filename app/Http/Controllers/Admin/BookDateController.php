<?php

namespace App\Http\Controllers\Admin;

use App\AvailableDate;
use App\BookDate;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBookDateRequest;
use App\Http\Requests\StoreBookDateRequest;
use App\Http\Requests\UpdateBookDateRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
use App\Student;
use App\Http\Requests\StudentExistRequest;

class BookDateController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('book_date_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $students = Student::with('studentBookDate.date')->get();

        return view('admin.bookDates.index', compact('students'));
    }

    public function create(StudentExistRequest $request)
    {
        abort_if(Gate::denies('book_date_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $student_id = $request->student_id;

        $dates = AvailableDate::all()->pluck('available_date', 'available_date_id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.bookDates.create', compact(['dates', 'student_id']));
    }

    public function store(StoreBookDateRequest $request)
    {
        $bookDate = BookDate::create([
            'book_date_id' => Str::random(5),
            'available_date_id' => $request->available_date_id,
            'student_id' => $request->student_id,
        ]);

        return redirect()->route('admin.book-dates.index',compact('bookDate'));
    }

    public function edit(BookDate $bookDate)
    {
        abort_if(Gate::denies('book_date_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dates = AvailableDate::all()->pluck('available_date', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bookDate->load('student', 'date');

        return view('admin.bookDates.edit', compact('dates', 'bookDate'));
    }

    public function update(UpdateBookDateRequest $request, BookDate $bookDate)
    {
        $bookDate->update($request->all());

        return redirect()->route('admin.book-dates.index');
    }

    public function show(BookDate $bookDate)
    {
        abort_if(Gate::denies('book_date_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bookDate->load('student', 'date');

        return view('admin.bookDates.show', compact('bookDate'));
    }

    public function destroy(BookDate $bookDate)
    {
        abort_if(Gate::denies('book_date_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bookDate->delete();

        return back();
    }

    public function massDestroy(MassDestroyBookDateRequest $request)
    {
        BookDate::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
