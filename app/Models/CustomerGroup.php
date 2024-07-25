<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerGroup extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function coupons()
    {
        return $this->hasMany(Coupon::class);
    }


    public function users()
    {
        return $this->hasMany(User::class);
    }
    
}
