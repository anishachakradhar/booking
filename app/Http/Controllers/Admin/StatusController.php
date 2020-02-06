<?php

namespace App\Http\Controllers\Admin;

use Gate;
use App\Student;
use App\BookDate;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePaymentRequest;
use Symfony\Component\HttpFoundation\Response;

class StatusController extends Controller
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
    public function create($id)
    {
        abort_if(Gate::denies('payment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $bookDateStatus = BookDate::STATUS_SELECT;
        $book_date = BookDate::where('book_date_id',$id)->first();
        // dd($book_date->toArray());
        // $book_date = BookDate::where('book_date_id',$id)->pluck( 'book','available_date_id')->prepend(trans('global.pleaseSelect'), '');
        
        return view('admin.status.create',compact('book_date','bookDateStatus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePaymentRequest $request, $id)
    {
        $student = Student::where('book_date_id',$id)->first();
        $student->update([
            'book_date_status' => $request->book_date_status,
        ]);

        $bookDate = BookDate::where('book_date_id',$student->book_date_id)->first();

        $bookDate->update([
            'book_date_status' => $student->book_date_status,
        ]);

        return redirect()->route('admin.students.index');
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
