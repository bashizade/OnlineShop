<?php

namespace App\Http\Controllers;

use App\Http\Requests\Address\CreateRequest;
use App\Http\Requests\Address\UpdateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Address;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\User;
use App\Models\UserProductsFavorite;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = User::query()->findOrFail(auth()->id());
        return view('',compact('user'));
    }

    public function user_invoice()
    {
        $invoice = Invoice::query()->where('user_id',auth()->id())->get();
        return view('',compact('invoice'));
    }

    public function update(UserUpdateRequest $request,User $user)
    {
        $validate_data = $request->validated();

        $user->update($validate_data);

        return 'user updated';
    }

    public function address_create(CreateRequest $request)
    {
        $validate_data = $request->validated();
        $validate_data['user_id'] = auth()->id();

        Address::query()->create($validate_data);

        return 'address created';
    }

    public function address_update(UpdateRequest $request,Address $address)
    {
        $validate_data = $request->validated();

        $address->update($validate_data);

        return 'address updated';
    }

    public function add_favorite_product(Product $product)
    {
        UserProductsFavorite::query()->create([
            'user_id' => auth()->id(),
            'product_id' => $product->id
        ]);

        return 'product added to favorite list';
    }

    public function remove_favorite_product(Product $product)
    {
        UserProductsFavorite::query()->where([['user_id'=>auth()->id()],['product_id' => $product->id]])->delete();

        return 'product removed from favorite list';
    }
}
