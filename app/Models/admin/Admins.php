<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admins extends Authenticatable
{
     use HasFactory, Notifiable;
   protected $table = 'admins';

   protected $fillable = [
    'adminname',
    'email',
    'password',
    'photo'
   ];
}
