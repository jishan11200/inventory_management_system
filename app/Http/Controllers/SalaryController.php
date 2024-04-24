<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advance_salary;
use DB;

class SalaryController extends Controller
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
    public function advancedSalary()
    {
        return view('advancedSalary');
    }

     //all salary 
     public function allAdvancedSalary()
     {
        $salary = DB::table('advance_salaries')
                ->join('employees', 'advance_salaries.emp_id', 'employees.id')
                ->select('advance_salaries.*', 'employees.name', 'employees.salary', 'employees.photo')
                ->orderBy('id', 'DESC')
                ->get();
         return view('allAdvancedSalary',compact('salary'));
     }
     public function insertAdvanced(Request $request)
     {
        $month = $request->month;
        $emp_id = $request->emp_id;
        $advanced = DB::table('advance_salaries')
                                ->where('month',$month)
                                ->where('emp_id',$emp_id)
                                ->first();
        if ( $advanced === NULL) {
            $data = array();
            $data['emp_id'] = $request->emp_id;
            $data['month'] = $request->month;
            $data['year'] = $request->year;
            $data['advanced_salary'] = $request->advanced_salary;
           
    
            $advanced = DB::table('advance_salaries')->insert($data);
            if ($advanced) {
                $notification = array(
                    'message' => 'Successfully Advanced Paid',
                    'alert-type' => 'success'
                );
                return redirect()->route('all.advancedSalary')->with($notification);
            } else {
                $notification = array(
                    'message' => 'Error',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }
        }
        else {
            $notification = array(
                'message' => 'Oops! Already advanced paid in this month',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }  
     }
     public function paySalary()
     {
        // $month = date("F", strtotime("-1 month"));

        // $salary = DB::table('advance_salaries')
        //         ->join('employees', 'advance_salaries.emp_id', 'employees.id')
        //         ->select('advance_salaries.*', 'employees.name', 'employees.salary', 'employees.photo')
        //         ->where('month', $month)
        //         ->get();
        //  return view('paySalary',compact('salary'));
        $employee = DB::table('employees')->get();
        return view('paySalary',compact('employee'));
     }
     public function addCategory()
     {
        return view('addCategory');
     }
     public function insertCategory(Request $request)
     {
        $validatedData = $request->validate([
            'cat_name' => 'required|max:255',
          
            // Add validations for other fields if necessary
        ]);
        
        $data = array();
        $data['cat_name'] = $request->cat_name;
        $cat = DB::table('categories')->insert($data);
        if ($cat) {
            $notification = array(
                'message' => 'Successfully Category Inserted',
                'alert-type' => 'success'
            );
            return redirect()->route('all.category')->with($notification);
        } else {
            $notification = array(
                'message' => 'Error',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
     }
     public function allCategory()
     {
        $allCat = DB::table('categories')->get();
        return view('allCategory',compact('allCat'));
     }

      //Delete single Category
    public function deleteCategory($id)
    {
        $delete = DB::table('categories')
                    ->where('id', $id)
                    ->delete();

        // Prepare a notification message based on the outcome of the delete operation
        if ($delete) {
            $notification = array(
                'message' => 'Successfully Category Deleted', // Corrected from 'Inserted' to 'Deleted'
                'alert-type' => 'success'
            );
            return redirect()->route('all.category')->with($notification);
        } else {
            $notification = array(
                'message' => 'Error',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function editCategory($id)
    {
        // Using query builder to get the employee's data
        $category = DB::table('categories')
                    ->where('id', $id)
                    ->first();

        // Check if Category exists
        if (!$category) {
            // Redirect or show a 404 error
            abort(404, 'Category not found');
        }

        // If employee exists, pass the data to the edit view
        return view('editCategory', compact('category'));
    }

    //Update category
    public function updateCategory(Request $request, $id)
    {
        $validatedData = $request->validate([
            'cat_name' => 'required|max:255',
          
            // Add validations for other fields if necessary
        ]);
        
        $data = $request->only(['cat_name']);
        $user = DB::table('categories')->where('id', $id)->update($data);
            if ($user) {
                $notification = array(
                    'message' => 'Successfully Category Updated', // Corrected from 'Inserted' to 'Deleted'
                    'alert-type' => 'success'
                );
                return redirect()->route('all.category')->with($notification);
            } else {
                $notification = array(
                    'message' => 'Update Failed',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
                
            }
      
        
       
    }


}
