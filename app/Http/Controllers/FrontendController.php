<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{

    public function home() {
        $product = Product::simplePaginate(11);
        return view('Home', compact('product'));
    }


}
