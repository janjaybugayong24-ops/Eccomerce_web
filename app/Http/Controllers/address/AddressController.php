<?php

namespace App\Http\Controllers\address;

use App\Http\Controllers\Controller;
use App\Http\Helpers\AddressHelper\Addresshelper;
use App\Models\address\Addresses;
use App\Models\customer\Customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class AddressController extends Controller
{
  private function address_helper($request)
  {
    return new Addresshelper($request);
  }

  public function index($id)
  {

    $address = DB::table('address')->where('customer_id', $id)->get();

    return view('addresses.index', compact('address'));
  }


  public function create()
  {
    return view('addresses.create');
  }

  public function store(Request $request)
  {

    $validate = $request->validate(
      [
        'FullName' => 'required|string|max:50',
        'email' => 'required|email|unique:address',
        'phone_number' => 'required|regex:/^09\d{9}$/|unique:address,phone_number',
        'main_address' => 'required|string|max:100',
        'city' => 'required|string|max:50',
        'province' => 'required|string|max:50',
        'postal_code' => 'required|string|max:20'
      ]
    );

    $address_helper = $this->address_helper($validate);

    $address_helper->address_data();

    $customer_id = Auth::user()->id;

    return redirect()->route('address.info', $customer_id);
  }

  public function edit($id)
  {

    $address = Addresses::findOrFail($id);

    return view('addresses.edit', compact('address'));
  }

  public function update(Request $request, $id)
  {
    $validate = $request->validate(
      [
        'FullName' => 'required|string|max:50',
        'email' => 'email',
        'phone_number' => 'required|regex:/^09\d{9}$/|numeric',
        'main_address' => 'required|string|max:100',
        'city' => 'required|string|max:50',
        'province' => 'required|string|max:50',
        'postal_code' => 'required|string|max:20'

      ]
    );

    $address_helper = $this->address_helper($validate);

    $address_helper->address_data($id);

    $customer_id = Auth::user()->id;

    return redirect(route('address.info', $customer_id));
  }

  public function destroy($id)
  {

    $address = Addresses::findOrFail($id);

    $address->delete();

    $customer_id = Auth::user()->id;

    return redirect(route('address.info', $customer_id));
  }
}
