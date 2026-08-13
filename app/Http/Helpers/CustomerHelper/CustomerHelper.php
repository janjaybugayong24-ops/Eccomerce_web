<?php
namespace App\Http\Helpers\CustomerHelper;

use App\Models\customer\Customers;
use \Carbon\Carbon;


Class CustomerHelper {

    protected $request;

    public function __construct( $request ){

        $this->request = $request;

    }

    public function customerData($id = null ){
            Customers::updateOrCreate(
            ['id'  =>$id ],
            
             [

            'username' => $this->request['username'],

            'email' => $this->request['email'],

            'password' => $this->request['password'],


            ]);
    }

}

   








