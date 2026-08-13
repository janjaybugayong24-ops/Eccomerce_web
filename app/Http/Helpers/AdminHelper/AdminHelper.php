<?php
namespace App\Http\Helpers\AdminHelper;

use App\Models\admin\Admins;

class AdminHelper{
       
     protected $request;

    public function __construct($request) {
      $this->request = $request;
    }

    public function admin_data($id = null) {
       Admins::updateOrCreate(
        ['id' => $id],

        [
         
         'adminname' => $this->request['adminname'],

         'email' => $this->request['email'],

         'password' => $this->request['password']

        ]); 
    }
}

