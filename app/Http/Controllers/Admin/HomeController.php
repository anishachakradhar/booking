<?php

namespace App\Http\Controllers\Admin;

use App\Student;

class HomeController
{
    public function index()
    {
        $students = Student::all();
        $countAll = [];
        foreach($students as $student)
        {
            $count = $student->book_date_status;
            array_push($countAll, $count);
        }
        $totalCount = count($countAll);
        $singleCount = array_count_values($countAll);
        // dd($singleCount);
        return view('home',compact('singleCount','totalCount'));
    }
}
