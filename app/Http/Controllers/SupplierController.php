<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class SupplierController extends Controller
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
        return view('addSupplier');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:suppliers|max:255',
            'address' => 'required',
            'phone' => 'required|unique:suppliers|max:33',
            'photo' => 'required',
            'city' => 'required',
        ]);
        
        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;
        $data['shop'] = $request->shop;
        $data['accountholder'] = $request->accountholder;
        $data['accountnumber'] = $request->accountnumber;
        $data['bankname'] = $request->bankname;
        $data['bankbranch'] = $request->bankbranch;
        $data['city'] = $request->city;
        $data['type'] = $request->type;

        // echo "<pre>";
        // print_r($data);
        // exit();
        $image = $request->file('photo');
        
        if ($image) {
            $image_name = str_random(5); // The $id should be previously defined, usually the user ID.
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'public/supplier/';
            $image_url = $upload_path . $image_full_name;
            $success = $image->move($upload_path, $image_full_name);
        
            if ($success) {
                $data['photo'] = $image_url;
                $supplier = DB::table('suppliers')
                                ->insert($data);
            
                if ($supplier) {
                    $notification = array(
                        'message' => 'Successfully Supplier Inserted',
                        'alert-type' => 'success'
                    );
                    return redirect()->route('all.supplier')->with($notification);
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
     public function suppliers()
     {
        $supplier = DB::table('suppliers')->get();
        //  $customers = Customer::all();
         return view('allSupplier')->with('supplier',$supplier);
     }
     
      //single supplier
    public function viewSupplier($id)
    {
        $single = DB::table('suppliers')
                    ->where('id', $id)
                    ->first();
       return view('viewSupplier',compact('single'));
    }

      //Delete single Supplier
      public function deleteSupplier($id)
      {
          $supplier = DB::table('suppliers')
                      ->where('id', $id)
                      ->first();
          // If an employee is found, delete the photo file
          if ($supplier) {
              $photo = $supplier->photo;
              if (file_exists($photo)) {
                  unlink($photo);
              }
          }
          
          // Delete the employee 
          $delete = DB::table('suppliers')
                      ->where('id', $id)
                      ->delete();
  
          // Prepare a notification message based on the outcome of the delete operation
          if ($delete) {
              $notification = array(
                  'message' => 'Successfully Supplier Deleted', // Corrected from 'Inserted' to 'Deleted'
                  'alert-type' => 'success'
              );
              return redirect()->route('all.supplier')->with($notification);
          } else {
              $notification = array(
                  'message' => 'Error',
                  'alert-type' => 'error'
              );
              return redirect()->back()->with($notification);
          }
      }

      public function editSupplier($id)
      {
          // Using query builder to get the employee's data
          $supplier = DB::table('suppliers')
                      ->where('id', $id)
                      ->first();
  
          // Check if employee exists
          if (!$supplier) {
              // Redirect or show a 404 error
              abort(404, 'Supplier not found');
          }
  
          // If employee exists, pass the data to the edit view
          return view('editSupplier', compact('supplier'));
      }
      //Supplier update
      public function updateSupplier(Request $request, $id)
      {
          $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'address' => 'required',
            'phone' => 'required|max:33',
            'city' => 'required',
              // Add validations for other fields if necessary
          ]);
          
          $data = $request->only(['name', 'email', 'phone', 'address','type', 'shop', 'accountholder', 'accountnumber', 'bankname','bankbranch', 'city']);
  
          $image = $request->file('photo');
          
          if ($image) {
              $image_name = Str::random(5); // Fixed the function call
              $ext = strtolower($image->getClientOriginalExtension());
              $image_full_name = $image_name . '.' . $ext;
              $upload_path = 'public/supplier/';
              $image_url = $upload_path . $image_full_name;
              $success = $image->move($upload_path, $image_full_name);
          
              if ($success) {
                  $img = DB::table('suppliers')->where('id', $id)->first();
                  if ($img->photo && File::exists($img->photo)) {
                      File::delete($img->photo); // Using File facade to handle file operations
                  }
  
                  $data['photo'] = $image_url; // Updating the image URL in the data array
                  $user = DB::table('suppliers')->where('id', $id)->update($data);
              
                  if ($user) {
                    $notification = array(
                        'message' => 'Successfully Supplier Updated', // Corrected from 'Inserted' to 'Deleted'
                        'alert-type' => 'success'
                    );
                      return redirect()->route('all.supplier')->with($notification);
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
              $user = DB::table('suppliers')->where('id', $id)->update($data);
              if ($user) {
                $notification = array(
                    'message' => 'Successfully Supplier Updated', // Corrected from 'Inserted' to 'Deleted'
                    'alert-type' => 'success'
                );
                  return redirect()->route('all.supplier')->with($notification);
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
