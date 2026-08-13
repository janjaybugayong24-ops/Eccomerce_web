<?php 
namespace  App\Http\Helpers\AddressHelper;

use App\Models\address\Addresses;
use Illuminate\Support\Facades\Auth;

class Addresshelper{
 protected $request;

 public function __construct($request){

    $this->request = $request;
 }

 public function address_data($id = null) {

     Addresses::updateOrCreate(
      ['id' =>$id],

      [
    'customer_id' =>  Auth::user()->id,

    'FullName' => $this->request['FullName'],

    'email' => $this->request['email'],

    'phone_number' => $this->request['phone_number'],

    'main_address' => $this->request['main_address'],

    'city' => $this->request['city'],

    'province' => $this->request['province'],

    'postal_code' => $this->request['postal_code'],

      ]);

 }

}

?>
