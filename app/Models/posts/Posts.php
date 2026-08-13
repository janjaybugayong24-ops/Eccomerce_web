<?php

namespace App\Models\posts;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $table = 'posts';

    protected $fillable = ['title', 'body'];
}
