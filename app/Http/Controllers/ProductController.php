<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
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
    public function addProduct()
    {
        return view('addProduct');
    }

    public function insertProduct(Request $request)
    {
        $validatedData = $request->validate([
            'product_name' => 'required|max:255',
            'product_code' => 'required',
            'product_garage' => 'required',
            'product_route' => 'required',
            
            'product_image' => 'required',
        ]);
        
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['cat_id'] = $request->cat_id;
        $data['sup_id'] = $request->sup_id;
        $data['product_code'] = $request->product_code;
        $data['product_garage'] = $request->product_garage;
        $data['product_route'] = $request->product_route;
        $data['buy_date'] = $request->buy_date;
        $data['expire_date'] = $request->expire_date;
        $data['buying_price'] = $request->buying_price;
        $data['selling_price'] = $request->selling_price;

        // echo "<pre>";
        // print_r($data);
        // exit();
        $image = $request->file('product_image');
        
        if ($image) {
            $image_name = str_random(5); // The $id should be previously defined, usually the user ID.
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'public/products/';
            $image_url = $upload_path . $image_full_name;
            $success = $image->move($upload_path, $image_full_name);
        
            if ($success) {
                $data['product_image'] = $image_url;
                $product = DB::table('products')
                                ->insert($data);
            
                if ($product) {
                    $notification = array(
                        'message' => 'Successfully Product Inserted',
                        'alert-type' => 'success'
                    );
                    return redirect()->route('all.product')->with($notification);
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

    public function allProduct()
    {
        $product = DB::table('products')->get();
         return view('allProduct',compact('product'));
    }
    //single Product
    public function viewProduct($id)
    {
        $product = DB::table('products')
                    ->join('categories', 'products.cat_id', 'categories.id')
                    ->join('suppliers', 'products.sup_id', 'suppliers.id')
                    ->select('categories.cat_name','products.*', 'suppliers.name')
                    ->where('products.id',$id)
                    ->first();
                    

                    // $product = DB::table('products')
                    // ->join('categories', 'products.cat_id',  'categories.id')
                    // ->join('suppliers', 'products.sup_id','suppliers.id')
                    // ->select('categories.cat_name', 'products.*','suppliers.name')
                    // ->where('products.id', $id)
                    // ->first();
        return view('viewProduct',compact('product'));
    }

    //Delete single Product
    public function deleteProduct($id)
    {
        $product = DB::table('products')
                    ->where('id', $id)
                    ->first();
        // If an Product is found, delete the photo file
        if ($product) {
            $photo = $product->product_image;
            if (file_exists($photo)) {
                unlink($photo);
            }
        }
        
        // Delete the Product 
        $delete = DB::table('products')
                    ->where('id', $id)
                    ->delete();

        // Prepare a notification message based on the outcome of the delete operation
        if ($delete) {
            $notification = array(
                'message' => 'Successfully Product Deleted', // Corrected from 'Inserted' to 'Deleted'
                'alert-type' => 'success'
            );
            return redirect()->route('all.product')->with($notification);
        } else {
            $notification = array(
                'message' => 'Error',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
    public function editProduct($id)
    {
        // Using query builder to get the product's data
        $product = DB::table('products')
                    ->where('id', $id)
                    ->first();

        // Check if employee exists
        if (!$product) {
            // Redirect or show a 404 error
            abort(404, 'Product not found');
        }

        // If Product exists, pass the data to the edit view
        return view('editProduct', compact('product'));
    }

    public function updateProduct(Request $request, $id)
      {
          $validatedData = $request->validate([
          
            'product_name' => 'required|max:255',
            'product_code' => 'required',
            'product_garage' => 'required',
            'product_route' => 'required',
          ]);
          
          $data = $request->only(['product_name', 'cat_id', 'sup_id', 'product_code', 'product_garage', 'product_route', 'product_image', 'buy_date','expire_date', 'buying_price','selling_price']);
  
          $image = $request->file('product_image');
          
          if ($image) {
              $image_name = Str::random(5); // Fixed the function call
              $ext = strtolower($image->getClientOriginalExtension());
              $image_full_name = $image_name . '.' . $ext;
              $upload_path = 'public/products/';
              $image_url = $upload_path . $image_full_name;
              $success = $image->move($upload_path, $image_full_name);
          
              if ($success) {
                  $img = DB::table('products')->where('id', $id)->first();
                  if ($img->product_image && File::exists($img->product_image)) {
                      File::delete($img->product_image); // Using File facade to handle file operations
                  }
  
                  $data['product_image'] = $image_url; // Updating the image URL in the data array
                  $user = DB::table('products')->where('id', $id)->update($data);
              
                  if ($user) {
                    $notification = array(
                        'message' => 'Successfully Product Updated', // Corrected from 'Inserted' to 'Deleted'
                        'alert-type' => 'success'
                    );
                      return redirect()->route('all.product')->with($notification);
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
              $user = DB::table('products')->where('id', $id)->update($data);
              if ($user) {
                $notification = array(
                    'message' => 'Successfully Product Updated', // Corrected from 'Inserted' to 'Deleted'
                    'alert-type' => 'success'
                );
                  return redirect()->route('all.product')->with($notification);
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
