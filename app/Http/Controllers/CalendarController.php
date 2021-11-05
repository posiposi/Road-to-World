<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservation;

class CalendarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function show()
    {
        $cal = new Calendar();
        $tag = $cal->showCalendarTag($request->month,$request->year);
        return view('calendars.show', ['cal_tag' => $tag]);
    }
}
