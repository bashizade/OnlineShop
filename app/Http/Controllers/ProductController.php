<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\CreateRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::query()->where('status',1)->get();
        return view('',compact('products'));
    }

    public function create(CreateRequest $request)
    {
        $validate_data = $request->validated();

        $validate_data['image'] = $request->image->store('product');

        $product = Product::query()->create($validate_data);

        foreach ($request->categories as $category) {
            $product->category->create([
                'category_id' => $category
            ]);
        }

        return 'product created';
    }

    public function update(UpdateRequest $request,Product $product)
    {
        $validate_data = $request->validated();

        if ($validate_data['image'])
            $validate_data['image'] = $request->image->store('product');

        $product->update($validate_data);

        $product->category->delete();
        foreach ($request->categories as $category) {
            $product->category->create([
                'category_id' => $category
            ]);
        }

        return 'product updated';
    }

    public function delete(Product $product)
    {
        $product->update([
            'status' => 2
        ]);

        return 'product deleted';
    }
}
