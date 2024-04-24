<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;
use App\Models\Employee;
use Illuminate\Support\Facades\File;

class EmployeeController extends Controller
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
    public function index()
    {
        return view('addEmployee');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:employees|max:255',
            'nid_no' => 'required|unique:employees|max:255',
            'address' => 'required',
            'phone' => 'required|max:33',
            'photo' => 'required',
            'salary' => 'required',
        ]);
        
        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;
        $data['nid_no'] = $request->nid_no;
        $data['experience'] = $request->experience;
        
        $data['salary'] = $request->salary;
        $data['vacation'] = $request->vacation;
        $data['city'] = $request->city;
        $image = $request->file('photo');
        
        if ($image) {
            $image_name = str_random(5); // The $id should be previously defined, usually the user ID.
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'public/employee/';
            $image_url = $upload_path . $image_full_name;
            $success = $image->move($upload_path, $image_full_name);
        
            if ($success) {
                $data['photo'] = $image_url;
                $employee = DB::table('employees')->insert($data);
            
                if ($employee) {
                    $notification = array(
                        'message' => 'Successfully Employee Inserted',
                        'alert-type' => 'success'
                    );
                    return redirect()->route('all.employee')->with($notification);
                } else {
                    $notification = array(
                        'message' => 'Error',
                        'alert-type' => 'error'
                    );
                    return redirect()->back()->with($notification);
                }
            } else {
                return redirect()->back()->with('error', 'Failed to upload the image.');
            }
        }
        else{
            return redirect()->back()->with('error', 'Failed to upload the image.');
        }
        
    }

    //all Employee
    public function employees()
    {
        $employees = Employee::all();
        return view('allEmployee',compact('employees'));
    }
    //single Employee
    public function viewEmployee($id)
    {
        $single = DB::table('employees')
                    ->where('id', $id)
                    ->first();
       return view('viewEmployee',compact('single'));
    }

    //Delete single employee
    public function deleteEmployee($id)
    {
        $employee = DB::table('employees')
                    ->where('id', $id)
                    ->first();
        // If an employee is found, delete the photo file
        if ($employee) {
            $photo = $employee->photo;
            if (file_exists($photo)) {
                unlink($photo);
            }
        }
        
        // Delete the employee 
        $delete = DB::table('employees')
                    ->where('id', $id)
                    ->delete();

        // Prepare a notification message based on the outcome of the delete operation
        if ($delete) {
            $notification = array(
                'message' => 'Successfully Employee Deleted', // Corrected from 'Inserted' to 'Deleted'
                'alert-type' => 'success'
            );
            return redirect()->route('all.employee')->with($notification);
        } else {
            $notification = array(
                'message' => 'Error',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
    public function editEmployee($id)
    {
        // Using query builder to get the employee's data
        $employee = DB::table('employees')
                    ->where('id', $id)
                    ->first();

        // Check if employee exists
        if (!$employee) {
            // Redirect or show a 404 error
            abort(404, 'Employee not found');
        }

        // If employee exists, pass the data to the edit view
        return view('editEmployee', compact('employee'));
    }
    //update employee information
    // public function updateEmployee(Request $request,$id)
    // {
    //     $validatedData = $request->validate([
    //         'name' => 'required|max:255',
    //         'email' => 'required|max:255',
    //         'nid_no' => 'required|max:255',
    //         'address' => 'required',
    //         'phone' => 'required|max:33',
    //         'salary' => 'required',
    //     ]);
        
    //     $data = array();
    //     $data['name'] = $request->name;
    //     $data['email'] = $request->email;
    //     $data['phone'] = $request->phone;
    //     $data['address'] = $request->address;
    //     $data['nid_no'] = $request->nid_no;
    //     $data['experience'] = $request->experience;
        
    //     $data['salary'] = $request->salary;
    //     $data['vacation'] = $request->vacation;
    //     $data['city'] = $request->city;
    //     $image = $request->file('photo');
        
    //     if ($image) {
    //         $image_name = str_random(20); // The $id should be previously defined, usually the user ID.
    //         $ext = strtolower($image->getClientOriginalExtension());
    //         $image_full_name = $image_name . '.' . $ext;
    //         $upload_path = 'public/employee/';
    //         $image_url = $upload_path . $image_full_name;
    //         $success = $image->move($upload_path, $image_full_name);
        
    //         if ($success) {
    //             $data['photo'] = $image_url;
    //             $img = DB::table('employees')->where('id', $id)->first();
    //             $image_path = $img->photo;
    //             $done = unlink($image_path);

               
    //             $user = DB::table('employees')->where('id', $id)->update($data);
            
    //             if ( $user) {
    //                 $notification = array(
    //                     'message' => 'Successfully Employee Updated',
    //                     'alert-type' => 'success'
    //                 );
    //                 return redirect()->route('all.employee')->with($notification);
    //             } else {
    //                 $notification = array(
    //                     'message' => 'Error',
    //                     'alert-type' => 'error'
    //                 );
    //                 return redirect()->back()->with($notification);
    //             }
    //         } else {
    //             return redirect()->back()->with('error', 'Failed to upload the image.');
    //         }
    //     }
    //     else{
    //         return redirect()->back()->with('error', 'Failed to upload the image.');
    //     }
        
    // }


    public function updateEmployee(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'nid_no' => 'required|max:255',
            'address' => 'required',
            'phone' => 'required|max:33',
            'salary' => 'required',
            // Add validations for other fields if necessary
        ]);
        
        $data = $request->only(['name', 'email', 'phone', 'address', 'nid_no', 'experience', 'salary', 'vacation', 'city']);

        $image = $request->file('photo');
        
        if ($image) {
            $image_name = Str::random(5); // Fixed the function call
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'public/employee/';
            $image_url = $upload_path . $image_full_name;
            $success = $image->move($upload_path, $image_full_name);
        
            if ($success) {
                $img = DB::table('employees')->where('id', $id)->first();
                if ($img->photo && File::exists($img->photo)) {
                    File::delete($img->photo); // Using File facade to handle file operations
                }

                $data['photo'] = $image_url; // Updating the image URL in the data array
                $user = DB::table('employees')->where('id', $id)->update($data);
            
                if ($user) {
                    $notification = array(
                        'message' => 'Successfully Employee Updated', // Corrected from 'Inserted' to 'Deleted'
                        'alert-type' => 'success'
                    );
                    return redirect()->route('all.employee')->with($notification);
                } else {
                    $notification = array(
                        'message' => 'Update Failed',
                        'alert-type' => 'error'
                    );
                    return redirect()->back()->with($notification);
                }
            } else {
                $notification = array(
                    'message' => 'Failed to upload the image.',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
                
            }
        } else {
            $user = DB::table('employees')->where('id', $id)->update($data);
            if ($user) {
                $notification = array(
                    'message' => 'Successfully Employee Updated', // Corrected from 'Inserted' to 'Deleted'
                    'alert-type' => 'success'
                );
                return redirect()->route('all.employee')->with($notification);
            } else {
                $notification = array(
                    'message' => 'Update Failed',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
                
            }
        }
    }


}