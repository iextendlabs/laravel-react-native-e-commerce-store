<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{

    public function home() {
        $category  = Category::all();
        $product = Product::simplePaginate(11);
        return view('Home', compact('product', 'category'));
    }

    public function categories_product(String $id)
    {
        $category  = Category::all();
        $product  = Product::where('category_id', $id)->simplePaginate(11);
        return view('Home', compact('product', 'category'));
        dd($product);
    }

    public function product_detail(Product $product)
    {
        return view('product.product_detail', compact('product'));
    }


}
