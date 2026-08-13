<?php

namespace App\Models\rating;

use Illuminate\Database\Eloquent\Model;

class Ratings extends Model
{
    protected $table = 'Ratings';

    protected$fillable = [
        'customer_id',
        'product_id',
        'rated_star'
    ];
}
