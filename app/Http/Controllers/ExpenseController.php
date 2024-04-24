<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ExpenseController extends Controller
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
    public function addExpense()
    {
        return view('addExpense');
    }
    public function insertExpense(Request $request)
    {
        $data = array();
        $data['details'] = $request->details;
        $data['amount'] = $request->amount;
        $data['date'] = $request->date;
        $data['month'] = $request->month;
        $data['year'] = $request->year;
        $expense = DB::table('expenses')->insert($data);
        if ($expense) {
            $notification = array(
                'message' => 'Successfully Expenses Inserted',
                'alert-type' => 'success'
            );
            return redirect()->route('today.expense')->with($notification);
        } else {
            $notification = array(
                'message' => 'Error',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        
    }

    public function todayExpense()
    {
        $date = date('d-m-y');
        $today = DB::table('expenses')->where('date',$date)->get();
        return view('todayExpense',compact('today'));
    }
    //Delete single delete
    public function deleteExpense($id)
    {
       
        
        // Delete the Expenses 
        $delete = DB::table('expenses')
                    ->where('id', $id)
                    ->delete();

        // Prepare a notification message based on the outcome of the delete operation
        if ($delete) {
            $notification = array(
                'message' => 'Successfully Expenses Deleted', // Corrected from 'Inserted' to 'Deleted'
                'alert-type' => 'success'
            );
            return redirect()->route('today.expense')->with($notification);
        } else {
            $notification = array(
                'message' => 'Error',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function editToday($id)
    {
        $today = DB::table('expenses')->where('id',$id)->first();
        return view('editToday',compact('today'));
    }
    public function updateToday(Request $request,$id)
    {
        $data = array();
        $data['details'] = $request->details;
        $data['amount'] = $request->amount;
        $data['date'] = $request->date;
        $data['month'] = $request->month;
        $data['year'] = $request->year;
        $expense = DB::table('expenses')->where('id',$id)->update($data);
        if ($expense) {
            $notification = array(
                'message' => 'Successfully Expenses Updated',
                'alert-type' => 'success'
            );
            return redirect()->route('today.expense')->with($notification);
        } else {
            $notification = array(
                'message' => 'Error',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

    }
    public function monthlyExpense()
    {
        $month = date('F');
        $monthly = DB::table('expenses')->where('month',$month)->get();
        return view('monthExpense',compact('monthly'));
    }
    public function yearlyExpense()
    {
        $year = date('Y');
        $yearly = DB::table('expenses')->where('year',$year)->get();
        return view('yearExpense',compact('yearly'));
    }
    public function januaryExpense()
    {
        $month = 'January';
        $monthly = DB::table('expenses')->where('month',$month)->get();
        return view('monthExpense',compact('monthly'));

    }
    public function februaryExpense()
    {
        $month = 'February';
        $monthly = DB::table('expenses')->where('month',$month)->get();
        return view('monthExpense',compact('monthly'));

    }
    public function marchExpense()
    {
        $month = 'March';
        $monthly = DB::table('expenses')->where('month',$month)->get();
        return view('monthExpense',compact('monthly'));

    }
    public function aprilExpense()
    {
        $month = 'April';
        $monthly = DB::table('expenses')->where('month',$month)->get();
        return view('monthExpense',compact('monthly'));

    }
    public function mayExpense()
    {
        $month = 'May';
        $monthly = DB::table('expenses')->where('month',$month)->get();
        return view('monthExpense',compact('monthly'));

    }
    public function juneExpense()
    {
        $month = 'June';
        $monthly = DB::table('expenses')->where('month',$month)->get();
        return view('monthExpense',compact('monthly'));

    }
    public function julyExpense()
    {
        $month = 'July';
        $monthly = DB::table('expenses')->where('month',$month)->get();
        return view('monthExpense',compact('monthly'));

    }
    public function augustExpense()
    {
        $month = 'August';
        $monthly = DB::table('expenses')->where('month',$month)->get();
        return view('monthExpense',compact('monthly'));

    }
    public function septemberExpense()
    {
        $month = 'September';
        $monthly = DB::table('expenses')->where('month',$month)->get();
        return view('monthExpense',compact('monthly'));

    }
    public function octoberExpense()
    {
        $month = 'October';
        $monthly = DB::table('expenses')->where('month',$month)->get();
        return view('monthExpense',compact('monthly'));

    }
    public function novemberExpense()
    {
        $month = 'November';
        $monthly = DB::table('expenses')->where('month',$month)->get();
        return view('monthExpense',compact('monthly'));

    }
    public function decemberExpense()
    {
        $month = 'December';
        $monthly = DB::table('expenses')->where('month',$month)->get();
        return view('monthExpense',compact('monthly'));

    }
   


}
