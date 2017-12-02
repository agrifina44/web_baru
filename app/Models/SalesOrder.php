<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    protected $table = 'salesOrders';
    protected $fillable = ['tanggal', 'salesChannel', 'salesPerson', 'type', 'customer', 'shippingAddress','billingAddress','total','status'];
}
