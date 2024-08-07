<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'image', 'price', 'quantity', 'description', 'category_id'];

    public Function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function order_products()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function discount_product() 
    {
        return $this->belongsTo(ProductDiscount::class, 'id' , 'products_id');
    }

}
