<?php

namespace App\Models\customer;

use App\Models\address\Addresses;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\order\Orders;
use App\Models\review\Reviews;
use App\Models\wishlist\Wishlists;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;

class Customers extends Authenticatable implements MustVerifyEmail
{
    protected $table = 'customers';

    protected $fillable = [
    'username',
    'email',
    'password',
    'last_seen',
    'photo',
    'token'
    ];
  
    public function orders() {
        return $this->hasMany(Orders::class);
    }

    public function address() {
        return $this->hasOne(Addresses::class, 'customer_id');
    }

    public function review() {
        return $this->hasMany(Reviews::class);
    }

    public function wishlist() {
        return $this->hasMany(Wishlists::class);
    }


     /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

  
}


    
    


 