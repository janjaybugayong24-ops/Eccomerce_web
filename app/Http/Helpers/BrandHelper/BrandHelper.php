<?php

namespace App\Http\Helpers\BrandHelper;

use App\Models\brand\Brands;

use \Carbon\Carbon;
use Symfony\Component\HttpFoundation\Request;

class BrandHelper
{

    protected $request;

    public function __construct($request)
    {

        $this->request = $request;
    }

    public function brandData($id = null)
    {

        Brands::updateOrCreate(
            ['id'  => $id],

            [

                'brand_name' => $this->request['brand_name'],

                'slug' => $this->request['slug'],

                'status' => $this->request['status'] == TRUE ? '1' : '0',

                'description' => $this->request['description'],

            ]
        );
    }
}
