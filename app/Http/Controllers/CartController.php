<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(CartRequest $request)
    {
        $validate_data = $request->validated();

        if (Cart::query()->where([['user_id' => $validate_data['user_id']],['product_id' => $validate_data['product_id']]])->exists()){
            Cart::query()->where([['user_id' => $validate_data['user_id']],['product_id' => $validate_data['product_id']]])->increment('count');
        }else{
            Cart::query()->create($validate_data);
        }

        return 'product added to cart';
    }

    public function remove(CartRequest $request)
    {
        $validate_data = $request->validated();

        if (Cart::query()->where([['user_id' => $validate_data['user_id']],['product_id' => $validate_data['product_id']]])->first()->count > 1){
            Cart::query()->where([['user_id' => $validate_data['user_id']],['product_id' => $validate_data['product_id']]])->decrement('count');
        }else{
            Cart::query()->where([['user_id' => $validate_data['user_id']],['product_id' => $validate_data['product_id']]])->delete();
        }

        return 'product removed from cart';
    }
}
