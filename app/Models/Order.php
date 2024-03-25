<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'customer_address_id'];

    public function  user()
    {
        return $this->belongsTo(User::class);
    }

    public function customer_address()
    {
        return $this->belongsTo(CustomerAddress::class);
    }

    public function order_products()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function order_total()
    {
        return $this->hasOne(OrderTotal::class);
    }
}
