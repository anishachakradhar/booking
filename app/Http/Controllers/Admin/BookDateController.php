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

class BookDateController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('book_date_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bookDates = BookDate::all();

        return view('admin.bookDates.index', compact('bookDates'));
    }

    public function create()
    {
        abort_if(Gate::denies('book_date_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dates = AvailableDate::all()->pluck('available_date', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.bookDates.create', compact('dates'));
    }

    public function store(StoreBookDateRequest $request)
    {
        $bookDate = BookDate::create($request->all());

        return redirect()->route('admin.book-dates.index');
    }

    public function edit(BookDate $bookDate)
    {
        abort_if(Gate::denies('book_date_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dates = AvailableDate::all()->pluck('available_date', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bookDate->load('students_email', 'date');

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

        $bookDate->load('students_email', 'date');

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
