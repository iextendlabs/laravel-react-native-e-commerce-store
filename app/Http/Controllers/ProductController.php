<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Trait\FileUploadTrait;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::all();
        return view('product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        return view('product.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $image = $this->saveFile($request, 'products', $data['slug']);
        if ($image) $data['image'] = $image;
        $product = Product::create($data);
        return to_route('products.index');



    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $category = Category::all();
        return view('product.edit', compact('product', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->only('name', 'price', 'quantity', 'description', 'image');
        // dd($data);
        $product->update($data);
        $product->save();
        return to_route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $imagePath = 'storage/products/'.$product->image;
        $thumbPath = 'storage/products/thumb/'.$product->image;
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        
        if (file_exists($thumbPath)) {
            unlink($thumbPath);
        }
        // unlink($image, $thumb);
        $product->delete();
        return back();
    }
}
