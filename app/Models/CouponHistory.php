<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponHistory extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function coupon(){
        return $this->belongsTo(Coupon::class);
    }

    public function order(){
        return $this->belongsTo(Order::class);
    }
}
