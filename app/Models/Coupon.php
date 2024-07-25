<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Coupon extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function coupon_history()
    {
        return $this->hasMany(CouponHistory::class);
    }

    public function product()
    {
        return $this->belongsToMany(Product::class, 'coupon_to_products', 'coupon_id', 'product_id');
    }

    public function category()
    {
        return $this->belongsToMany(Category::class, 'coupon_to_categories', 'coupon_id', 'category_id');
    }

    public function customer_group()
    {
        return $this->hasOne(CustomerGroup::class, 'id', 'customer_groups_id');
    }



    public function discount($cart, $product_total)
    {
        $sub_total = 0;
        $coupon_category_product = [];
        $coupon_product = [];
        $applicable_product = [];
        if (!$this->category()->exists() && !$this->product()->exists()) {
            return $this->type == 'percentage' ? ($product_total * $this->discount) / 100 : $this->discount;
        } else {

            if ($this->category()->exists()) {
                $category_id = $this->category()->pluck('category_id')->toArray();
                foreach ($category_id as $value) {
                    $coupon_category_product = array_merge($coupon_category_product, Product::where('category_id', $value)->pluck('id')->toArray());
                }
            }
            if ($this->product()->exists()) {
                $coupon_product = $this->product()->pluck('product_id')->toArray();
            }

            $applicable_product = array_unique(array_merge($coupon_category_product, $coupon_product));

            $product = Product::whereIn('id', array_keys($cart))->get();

            if ($applicable_product) {
                foreach ($product as $value) {
                    if (in_array($value->id, $applicable_product)) {
                        $sub_total += $value->price;
                    }
                }
            }

            if ($sub_total) {
                return ($this->type == 'percentage') ? ($sub_total * $this->discount) / 100 : $this->discount;
            }
        }
        return 0;
    }

    public function isValid($code)
    {

        if (isset($this->customer_groups_id)) {
            $isValid = self::where('code', $code)
            ->where('customer_groups_id', Auth::user()->customer_groups_id)
            ->where('status', 'enable')
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->exists();

        } else {
            $isValid = self::where('code', $code)
            ->where('status', 'enable')
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->exists();
        }
        
        return $isValid;

    }
}
