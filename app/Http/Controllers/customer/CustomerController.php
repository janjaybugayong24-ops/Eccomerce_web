<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Http\Controllers\mail\MailController;
use App\Http\Helpers\CustomerHelper\CustomerHelper;
use App\Models\customer\Customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Mail\WebsiteMail;
use App\Models\address\Addresses;
use App\Models\cart\Carts;
use App\Models\deliveries\Delivery;
use App\Models\order\Orders;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use App\Models\posts\Posts;
use App\Models\shipping\Shipping;

use function Symfony\Component\String\s;

class CustomerController extends Controller
{

  private function customer_helper($request)
  {
    return new CustomerHelper($request);
  }

  public function customer_dashbord()
  {

    return view('customers.dashbord');
  }

  public function showRegister()
  {
    return  view('customers.register');
  }

  public function showLogin()
  {
    return view('customers.login');
  }


  public function register(Request $request)
  {

    $validate = $request->validate([
      'username' => 'required|string|max:255',
      'email' => 'required|email|unique:users',
      'password' => 'required|string|min:8|confirmed',
      'photo' => 'required|image|mimes:jpeg,jpg,png,gif'
    ]);

    $token = hash('sha256', time());

    $customer = new Customers();
    $customer->username = $validate['username'];
    $customer->email = $validate['email'];
    $customer->password = Hash::make($validate['password']);

    if ($request->hasFile('photo')) {

      $file = $request->file('photo');
      $extention = $file->getClientOriginalExtension();
      $filename = time() . '.' . $extention;
      $file->move('public/customer/', $filename);

      $customer->photo = $filename;
    }

    $customer->token = $token;

    $customer->save();

    $link = route('registration_verify', [$token, $request->email]);
    $subject = 'Registration Verification';
    $message = 'Click on the following link to verify your email: <br> <a href="' . $link . '">' . $link . '</a>';

    Mail::to($request->email)->send(new WebsiteMail($subject, $message));

    return redirect()->back()->with('success', 'Registration succesful. Please check you email to verify your account.');
  }


  public function registration_verify($token, $email)
  {

    $customer = Customers::where('email', $email)->where('token', $token)->first();

    if (!$customer) {

      return redirect()->route('show.login')->with('error', 'Invalid token or email');
    }

    $customer->token = '';
    $customer->update();

    return redirect()->route('show.login')->with('success', 'Email verified successfully, You can now login.');
  }



  public function login(Request $request)
  {

    $validate  = $request->validate([
      'email' => 'required|email',
      'password' => 'required|string|min:8',
    ]);

    if (Auth::attempt($validate)) {
      $request->session()->regenerate();
      return redirect(route('HomePage'))->with('status', 'Logged in Successfuly');
    } else {
      throw ValidationException::withMessages([
        'credentials' => 'sorry, incorrect Username or Password '
      ]);
    }
  }

  public function logout(Request $request)
  {

    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect(route('show.login'))->with('success', 'Logged out succcessfully');
  }

  /* public function index() {
       $display_customer = DB::table('customers')->get();

      return view('customers.index', ['customers' => $display_customer]);
    } 

    public function create() {
        return view('customers.create');
    } 
    */

  /* public function store(Request $request) {

    $validate = $request->validate([
     'username' => 'required|string|max:255',
     'email' => 'required|email|unique:users',
     'password' => 'required|string|min:8|confirmed'
    ]); 

      $customer_helper = $this->customer_helper($validate);

      $customer_helper->customerData();
      
      return redirect(route('customer.index'));
    }
    */

  public function edit($id)
  {
    $customer = Customers::findOrFail($id);

    return view('customers.edit', compact('customer'));
  }

  public function update(Request $request, $id)
  {

    $validate = $request->validate([
      'username' => 'required|string|max:255',
      'email' => 'required|email',
      'password' => 'required|string',
      'photo' => 'image|mimes:jpeg,jpg,png,gif'
    ]);

    $customer = Customers::find($id);

    if ($request->hasFile('photo')) {

      $destination = 'public/customer/' . $customer->photo;

      if (File::exists($destination)) {

        File::delete($destination);
      }
      $file = $request->file('photo');
      $extention = $file->getClientOriginalExtension();
      $filename = time() . '.' . $extention;
      $file->move('public/customer/', $filename);

      $customer->photo = $filename;
    }

    $customer->save();

    $customer_helper = $this->customer_helper($validate);

    $customer_helper->customerData($id);

    return redirect(route('customer.dashbord'));
  }

  public function destroy($id)
  {
    $customer = Customers::findOrFail($id);

    $customer->delete();

    return redirect(route('customer.index'));
  }



  public function forgetPassword()
  {

    return view('customers.forgetPassword');
  }

  public function forget_Password_Submit(Request $request)
  {

    $request->validate([
      'email' => 'required|email'
    ]);

    $customer = Customers::where('email', $request->email)->first();

    if (!$customer) {
      return redirect()->back()->with('error', 'Email Not Found');
    }

    $token = hash('sha256', time());
    $customer->token = $token;
    $customer->update();

    $link = route('customer_reset_password', [$token, $request->email]);
    $subject = 'Reset Password';
    $message = 'Click on the following link to reset your password:<br> <a href="' . $link . '">' . $link . '</a>';

    Mail::to($request->email)->send(new WebsiteMail($subject, $message));

    return redirect()->back()->with('success', 'Reset Password link sent to your email');
  }

  public function customer_reset_password(Request $request, $token, $email)
  {

    $customer = Customers::where('email', $email)->where('token', $token)->first();

    if (!$customer) {
      return redirect()->route('show.login')->with('error', 'Invalid token or email');
    }
    return view('customers.customer_reset_password', compact('token', 'email'));
  }

  public function reset_password_submit(Request $request, $token, $email)
  {
    $request->validate([
      'password' => 'required',
      'confirm_password' => 'required|same:password'
    ]);

    $customer = Customers::where('email', $email)->where('token', $token)->first();
    $customer->password = Hash::make($request->password);
    $customer->token = '';
    $customer->update();

    return redirect()->route('show.login')->with('success', 'Password reset seccessfully');
  }


  public function show_orders()
  {

    $orders = Orders::where('customer_id', Auth::user()->id)->get();

    $carts = Carts::where('customer_id', Auth::user()->id)->get();

    return view('customers.orders.show_orders', compact('orders', 'carts'));
  }

  public function view_order($id)
  {

    $orders = Orders::where('id', $id)->where('customer_id', Auth::user()->id)->first();

    $address = Addresses::where('customer_id', Auth::user()->id)->first();

    return view('customers.orders.view_order', compact('orders', 'address'));
  }

  public function shipping_details($order_id)
  {

    $check_shipping = Shipping::where('order_id', $order_id)->exists();

    if ($check_shipping) {

      $shipping_data = Shipping::where('order_id', $order_id)->first();

      return view('customers.shipping.shipping_details', compact('shipping_data'));
    } else {
      return redirect()->back()->with('status', 'Your order has not shipped yet.');
    }
  }

  public function delivery_details($shipping_id)
  {

    $check_shipping = Shipping::where('id', $shipping_id)->where('shipping_status', 2)->exists();

    $check_delivery = Delivery::where('shipping_id', $shipping_id)->exists();

    if ($check_shipping) {

      if ($check_delivery) {

        $delivery = Delivery::where('shipping_id', $shipping_id)->first();

        return view('customers.delivery.delivery_details', compact('delivery'));
      } else {
        return redirect()->back()->with('status', 'Delivery details does not exist yet');
      }
    } else {
      return redirect()->back()->with('status', 'Your order is not shipped yet.');
    }
  }

  /*
    public function sample(Request $request) {
        $pokename = 'pikachu';

       $response = Http::get('https://pokeapi.co/api/v2/pokemon/'.$pokename);

       dd($response->json());

    }

    public function sample_create() {

        $response = Http::post('https://jsonplaceholder.typicode.com/posts/',[
          'title' => 'Body fuck',
          'body' => 'bbi'
          ]);

          $response = $response->ok();

          dd($response);
    }



    public function register(Request $request) {

     $validate = $request->validate([
     'username' => 'required|string|max:255',
     'email' => 'required|email|unique:customers,email',
     'password' => 'required|string|min:8|confirmed',
     'photo' => 'required|image|mimes:jpeg,jpg,png,gif'
    ]); 

    $customer = new Customers();
    $customer->username = $validate['username'];
    $customer->email = $validate['email'];
    $customer->password = Hash::make($validate['password']);
    $customer->verification_code = sha1(time());  
     if ($request->hasFile('photo')){

        $file = $request->file('photo');
        $extention = $file->getClientOriginalExtension();
        $filename = time().'.'.$extention;
        $file->move('public/customer/', $filename);

        $customer->photo = $filename;
    }

      $customer->save();
     
      if ($customer != null) {
          MailController::sendSignupEmail($customer->username ,$customer->email, $customer->verification_code);
          return redirect()->back()->with(session()->flash('alert-success', 'Your account has been created, check your email for verification'));
        }

        return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong'));
    }
*/
}

//sample api
/*
 $response = Http::get('https://jsonplaceholder.typicode.com/posts');

       $posts = $response->body();
       dd($posts);


       more shorter:
        public function sample(Request $request) {

       $response = Http::get('https://jsonplaceholder.typicode.com/posts')->json();
       
       dd($response);


      $response = Http::get('https://jsonplaceholder.typicode.com/posts');

       $posts = $response->json();
       dd($posts);
    }

*/
