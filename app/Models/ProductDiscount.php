<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDiscount extends Model
{Auth::user()
    use HasFactory;

    protected $guarded = [];

    public function product() {
        return $this->hasOne(Product::class, 'id' , 'products_id');
    }
}
