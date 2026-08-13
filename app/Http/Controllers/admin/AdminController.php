<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\AdminHelper\AdminHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\admin\Admins;
use App\Mail\WebsiteMail;
use App\Models\address\Addresses;
use App\Models\brand\Brands;
use App\Models\category\Categories;
use App\Models\customer\Customers;
use App\Models\order\Orders;
use App\Models\product\Products;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;
class AdminController extends Controller
{

     private function admin_helper($request) {

       return new AdminHelper($request);
     }

    public function dashbord() {  

      $products = Products::all();

      $total_products = Products::where('status', '0')->count();

      $categories = Categories::where('status', '0')->count();

      $brands = Brands::where('status', '1')->count();

      $customer_count = DB::table('customers')->count();

    //  $customerActive = Customers::orderBy('last_seen', 'DESC')->get();

      $pending_orders = DB::table('orders')->where('order_status', '0')->count(); 

      $completed_orders = DB::table('orders')->where('order_status', '1')->count(); 

      return view('Admin.dashbord', compact('products', 'total_products', 'categories', 'brands', 'customer_count', 'pending_orders', 'completed_orders'));

    }

    public function adminlogin() {

    return view('Admin.login');

    }

    public function loginSubmit(Request $request) {
        $validate = $request->validate([

          'email' => 'required|email',
          'password' => 'required|string'

        ]);

        $check = $request->all();

        $data = [
            'email' => $check['email'],
            'password' => $check['password']
        ];


        if (Auth::guard('admins')->attempt($data)) {

            return redirect()->route('admin.dashbord')->with('status', 'Welcome to dashbord admin');

        }else{
            return redirect()->back()->with('error', 'Invalid credentials');
        }
     
    }

    public function forgetPassword() {

    return view('Admin.forgetPassword');

    }

    public function forget_Password_Submit(Request $request) {
         
      $request->validate([
        'email' => 'required|email'
      ]);

      $admin = Admins::where('email', $request->email)->first();

      if (!$admin) {
         return redirect()->back()->with('error', 'Email Not Found');
      }

       $token = hash('sha256', time());
       $admin->token = $token;
       $admin->update();

       $link = route('admin_reset_password', [$token, $request->email]);
       $subject = 'Reset Password';
       $message = 'Click on the following link to reset your password:<br> <a href="'.$link.'">'.$link.'</a>';

       Mail::to($request->email)->send(new WebsiteMail($subject, $message));

       return redirect()->back()->with('success', 'Reset Password link sent to your email');
      
    }

    public function admin_reset_password(Request $request, $token, $email){

        $admin = Admins::where('email', $email)->where('token', $token)->first();

        if (!$admin) {
            return redirect()->route('admin.login')->with('error', 'Invalid token or email');
        }
         return view('Admin.admin_reset_password', compact('token', 'email'));
        
    }

    public function reset_password_submit(Request $request, $token, $email) {
          $request->validate([
            'password' => 'required',
            'confirm_password' => 'required|same:password'
          ]);

          $admin = Admins::where('email', $email)->where('token', $token)->first();
          $admin ->password = Hash::make($request->password);
          $admin->token = '';
          $admin->update();

          return redirect()->route('admin.login')->with('success', 'Password reset seccessfully');
    }

    public function Admin_logout() {

        Auth::guard('admins')->logout();

        return redirect(route('admin.login'))->with('success', 'Logged out succcessfully');
    }

   public function edit($id) {
      $admin = Admins::findOrFail($id);

      return view('Admin.edit', compact('admin')); 

    }

    public function update(Request $request, $id) {

    $validate = $request->validate([
      'adminname' => 'required|string|max:255',
      'email' => 'required|email',
      'password' => 'required|string',
      'photo' => 'image|mimes:jpeg,jpg,png,gif'
     ]); 
     
      $admin = Admins::find($id);

      if ($request->hasFile('photo')){
        
        $destination = 'public/admin/'.$admin->photo;

        if (File::exists($destination)) {

             File::delete($destination);
        }

        $file = $request->file('photo');
        $extention = $file->getClientOriginalExtension();
        $filename = time().'.'.$extention;
        $file->move('public/customer/', $filename);

        $admin->photo = $filename;   
    }

      $admin->save();

      $admin_helper = $this->admin_helper($validate);

      $admin_helper->admin_Data($id);

      return redirect(route('admin.dashbord'));
        
    }

    public function customer_view() {

         $customers = Customers::with('address')->get();
          $customerActive = Customers::orderBy('last_seen', 'DESC')->get();
         return view('Admin.customers.view_customers', compact('customers', 'customerActive'));
    } 

    public function customer_details($id) {
        $customer = Customers::with('address')->find($id);
        return view('Admin.customers.customer_details', compact('customer'));
        
    }
 
}


