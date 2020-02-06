<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function home()
    {
        return view('frontend.landing.home');
    }
    public function ielts()
    {
        return view('frontend.landing.select');
    }
}
