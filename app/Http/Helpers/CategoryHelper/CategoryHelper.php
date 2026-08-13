<?php
namespace App\Http\Helpers\CategoryHelper;

use App\Models\category\Categories;
use \Carbon\Carbon;


Class CategoryHelper {

    protected $request;

    public function __construct( $request ){

        $this->request = $request;

    }

    public function categoriesData($id = null ){
            Categories::updateOrCreate(
            ['id'  =>$id ],
            
             [

            'category_name' => $this->request['category_name'],

            'slug' => $this->request['slug'],

            'description' => $this->request['description'],

            'status' => $this->request['status'] == TRUE ? '1' : '0',

            'popular' => $this->request['popular'] == TRUE ? '1' : '0', 
            
            'meta_title' => $this->request['meta_title'],

            'meta_description' => $this->request['meta_description'],

            'meta_keywords' => $this->request['meta_keywords'],

            ]);

    }

}

   








