<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function details()
    {
        return $this->hasMany(OrderDetails::class, 'order_id');
    }

    public function customer()
    {
        return $this->belongsTo(customer::class, 'customer_id');
    }
}
