<?php
namespace App\Http\Helpers\CheckoutHelper;

class CheckoutHelper {
   
             private $data = [
                    'data' =>[
                        'attributes' => [
                            'line_items' =>[
                                [
                            'currency' => 'PHP',
                            'amount' => 120000,
                            'description' => 'sana gumana pare ko',
                            'name' => 'EAH',
                            'quantity' => 1,  
                            ]
                            ], 
                        'payment_method_types' => ['card'],
                        'success_url' => 'http://127.0.0.1:8000/success',
                        'cancel_url' => 'http://127.0.0.1:8000/success',
                        'description' => 'text',
                        ], 
                    ]
                    ];

                   

    public function checkout_data() {
    
       return $this->data;
            
    }

    public function data_pay() {

        $data['data']['attributes']['amount'] = 150050;
        $data['data']['attributes']['description'] = 'Yrahssss baby';

        return $data;
    }

}

?>