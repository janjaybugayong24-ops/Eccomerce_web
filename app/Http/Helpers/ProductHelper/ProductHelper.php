<?php

namespace App\Http\Helpers\ProductHelper;

use App\Models\product\Products;
use \Carbon\Carbon;

class ProductHelper
{

  protected $request;

  public function __construct($request)
  {
    $this->request = $request;
  }

  public function productData($id = null)
  {
    Products::updateOrCreate(
      ['id' => $id],

      [
        'product_name' => $this->request['product_name'],

        'stock_quantity' => $this->request['stock_quantity'],

        'price' => $this->request['price'],

        'description' => $this->request['description'],

        'status' => $this->request['status'] == TRUE ? '1' : '0',

        'trending' => $this->request['trending'] == TRUE ? '1' : '0',

        'meta_title' => $this->request['meta_title'],

        'meta_description' => $this->request['meta_description'],

        'meta_keywords' => $this->request['meta_keywords'],
      ]
    );
  }
}
