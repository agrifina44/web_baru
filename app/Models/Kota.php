<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
     protected $table = 'kotas';
    protected $fillable = ['kota','provinsi','status'];
}

