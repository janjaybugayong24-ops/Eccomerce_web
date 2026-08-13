<?php 
namespace App\Http\Helpers\OrderHelper;

use Illuminate\Support\Facades\DB;

Class OrderHelper{

  private $request; 
  public function __construct($request) {
    $this->request = $request;
  }

  public function request_order_info() {
  //dd($this->request['order']);

  return DB::table($this->request['order'])

  ->select($this->request['customer'].'.fullName', 

  $this->request['customers'].'.email', 

  $this->request['products'].'.name',

  $this->request['products'].'.qty', 

  $this->request['order_item'].'.order_quantity',

  $this->request['orders'].'.order_date', 

  $this->request['orders'].'.status',

  $this->request['orders'].'.total_amount')
  
  ->join($this->request['customers'], $this->request['orders'].'.customer_id', $this->request['customers'].'.id')

  ->join($this->request['order_items'], $this->request['orders'].'.id', $this->request['order_items'].'.order_id')
  
  ->join($this->request['products'], $this->request['products'].'.id', $this->request['order_items'].'.product_id')->get();
  }
}

?>


