<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class CustomerController extends Controller
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
        return view('addCustomer');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:customers|max:255',
            'address' => 'required',
            'phone' => 'required|unique:customers|max:33',
            'photo' => 'required',
            'city' => 'required',
        ]);
        
        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;
        $data['shop_name'] = $request->shop_name;
        $data['account_holder'] = $request->account_holder;
        $data['account_number'] = $request->account_number;
        $data['bank_name'] = $request->bank_name;
        $data['bank_branch'] = $request->bank_branch;
        $data['city'] = $request->city;

        // echo "<pre>";
        // print_r($data);
        // exit();
        $image = $request->file('photo');
        
        if ($image) {
            $image_name = str_random(5); // The $id should be previously defined, usually the user ID.
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'public/customer/';
            $image_url = $upload_path . $image_full_name;
            $success = $image->move($upload_path, $image_full_name);
        
            if ($success) {
                $data['photo'] = $image_url;
                $customer = DB::table('customers')
                                ->insert($data);
            
                if ($customer) {
                    $notification = array(
                        'message' => 'Successfully Customer Inserted',
                        'alert-type' => 'success'
                    );
                    return redirect()->route('home')->with($notification);
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

     //all Customer
     public function customers()
     {
        $customer = DB::table('customers')->get();
        //  $customers = Customer::all();
         return view('allCustomer')->with('customer',$customer);
     }

      //single Employee
    public function viewCustomer($id)
    {
        $single = DB::table('customers')
                    ->where('id', $id)
                    ->first();
       return view('viewCustomer',compact('single'));
    }

      //Delete single employee
      public function deleteCustomer($id)
      {
          $customer = DB::table('customers')
                      ->where('id', $id)
                      ->first();
          // If an employee is found, delete the photo file
          if ($customer) {
              $photo = $customer->photo;
              if (file_exists($photo)) {
                  unlink($photo);
              }
          }
          
          // Delete the employee 
          $delete = DB::table('customers')
                      ->where('id', $id)
                      ->delete();
  
          // Prepare a notification message based on the outcome of the delete operation
          if ($delete) {
              $notification = array(
                  'message' => 'Successfully Customer Deleted', // Corrected from 'Inserted' to 'Deleted'
                  'alert-type' => 'success'
              );
              return redirect()->route('all.customer')->with($notification);
          } else {
              $notification = array(
                  'message' => 'Error',
                  'alert-type' => 'error'
              );
              return redirect()->back()->with($notification);
          }
      }

      public function editCustomer($id)
      {
          // Using query builder to get the employee's data
          $customer = DB::table('customers')
                      ->where('id', $id)
                      ->first();
  
          // Check if employee exists
          if (!$customer) {
              // Redirect or show a 404 error
              abort(404, 'Customer not found');
          }
  
          // If employee exists, pass the data to the edit view
          return view('editCustomer', compact('customer'));
      }

      public function updateCustomer(Request $request, $id)
      {
          $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'address' => 'required',
            'phone' => 'required|max:33',
            
            'city' => 'required',
              // Add validations for other fields if necessary
          ]);
          
          $data = $request->only(['name', 'email', 'phone', 'address', 'shop_name', 'account_holder', 'account_number', 'bank_name','bank_branch', 'city']);
  
          $image = $request->file('photo');
          
          if ($image) {
              $image_name = Str::random(5); // Fixed the function call
              $ext = strtolower($image->getClientOriginalExtension());
              $image_full_name = $image_name . '.' . $ext;
              $upload_path = 'public/customer/';
              $image_url = $upload_path . $image_full_name;
              $success = $image->move($upload_path, $image_full_name);
          
              if ($success) {
                  $img = DB::table('customers')->where('id', $id)->first();
                  if ($img->photo && File::exists($img->photo)) {
                      File::delete($img->photo); // Using File facade to handle file operations
                  }
  
                  $data['photo'] = $image_url; // Updating the image URL in the data array
                  $user = DB::table('customers')->where('id', $id)->update($data);
              
                  if ($user) {
                    $notification = array(
                        'message' => 'Successfully Customer Updated', // Corrected from 'Inserted' to 'Deleted'
                        'alert-type' => 'success'
                    );
                      return redirect()->route('all.customer')->with($notification);
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
              $user = DB::table('customers')->where('id', $id)->update($data);
              if ($user) {
                $notification = array(
                    'message' => 'Successfully Customer Updated', // Corrected from 'Inserted' to 'Deleted'
                    'alert-type' => 'success'
                );
                  return redirect()->route('all.customer')->with($notification);
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
