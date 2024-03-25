<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTotal extends Model
{
    use HasFactory;

    protected $fillable = ['total', 'subtotal', 'discount', 'order_id'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
