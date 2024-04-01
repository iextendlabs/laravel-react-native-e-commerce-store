<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Trait\FileUploadTrait;
use App\Models\ProductImage;

class ProductImageController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productImage = ProductImage::all();
        return view('productImages.index', compact('productImage'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product = Product::all();
        return view('productImages.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image',],
            'product_id' => 'required'
        ]);
        $data = $request->all();
        $product = Product::find($request->product_id);
        $image = $this->saveFile($request, 'ProductImages', $product->slug);
        if ($image) $data['image'] = $image;
        ProductImage::create($data);
        return to_route('product-images.index');
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
    public function edit(ProductImage $product_image)
    {
        $product = Product::all();
        return view('productImages.edit', compact('product_image', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductImage $productImage)
    {
        $request->validate([
            'image' => ['required', 'image',],
            'product_id' => 'required'
        ]);

        if ($request->image) {
            $imagePath = 'storage/ProductImages/' . $productImage->image;
            $thumbPath = 'storage/ProductImages/thumb/' . $productImage->image;
            if (file_exists($imagePath) && file_exists($imagePath)) {
                unlink($imagePath);
                unlink($thumbPath);
            }
        }

        $data = $request->all();
        $product = Product::find($request->product_id)->value('slug');
        $image = $this->saveFile($request, 'ProductImages', $product);
        if ($image) $data['image'] = $image;
        $productImage->update($data);
        return to_route('product-images.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductImage $productImage)
    {
        $imagePath = 'storage/ProductImages/' . $productImage->image;
        $thumbPath = 'storage/ProductImages/thumb/' . $productImage->image;
        if (file_exists($imagePath) && file_exists($imagePath)) {
            unlink($imagePath);
            unlink($thumbPath);
        }
        $productImage->delete();
        return back();
    }
}
