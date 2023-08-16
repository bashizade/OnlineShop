<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceCreateRequest;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $addresses = Address::query()->where('status',1)->get();
        $carts = Cart::query()->where('user_id',auth()->id())->get();

        return view('',compact('addresses','carts'));
    }

    public function create(InvoiceCreateRequest $request)
    {
        $validate_data = $request->validated();
        $validate_data['user_id'] = auth()->id();

        $price = 0;
        $carts = Cart::query()->where('user_id',auth()->id())->get();
        foreach ($carts as $cart) {
            $price += (($cart->product->price_off == 0 ? $cart->product->price : $cart->product->price_off) * $cart->count);
        }
        $validate_data['price'] = $price;

        $invoice = Invoice::query()->create($validate_data);
        $invoice->update([
            'number' => $invoice->id + 1000
        ]);

        foreach ($carts as $cart) {
            $invoice->product->create([
                'product_id' => $cart->product_id,
                'count' => $cart->count,
                'price' => $cart->product->price_off == 0 ? $cart->product->price : $cart->product->price_off
            ]);
        }
        Cart::query()->where('user_id',auth()->id())->delete();

        // first send api to pay gate and give auth code and link and save auth to payment
        $invoice->payment->create([
            'auth_code' => "sd0f80s98df09s8df09sd8f908sdf098sd",
            'ref_code' => "#",
            'gate_name' => "zarinpal",
            'status' => 1
        ]);

        return 'to payment gate';
    }
}
