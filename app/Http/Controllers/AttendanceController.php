<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AttendanceController extends Controller
{
   
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function takeAttendance()
    {
        $employee = DB::table('employees')->get();
        return view('takeAttendance',compact('employee'));
    }
    public function insertAttendance(Request $request)
    {
        $date = array();
        $data['att_date'] = $request->att_date;
        $data['att_year'] = $request->att_year;
        echo "<pre>";
        print_r($data);
        exit();

    }
    public function allAttendance()
    {
        echo "done";
    }
}
