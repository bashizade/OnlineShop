<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CreateRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::query()->where('status',1)->get();
        return view('',compact('categories'));
    }

    public function create(CreateRequest $request)
    {
        $validate_data = $request->validated();

        Category::query()->create($validate_data);

        return 'category created';
    }

    public function update(UpdateRequest $request,Category $category)
    {
        $validate_data = $request->validated();

        $category->update($validate_data);

        return 'category updated';
    }

    public function delete(Category $category)
    {
        $category->update([
            'status' => 2
        ]);

        return 'category deleted';
    }
}
