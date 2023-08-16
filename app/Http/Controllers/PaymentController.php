<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function callback(Request $request)
    {
        $request->validate([
            'status' => 'required',
            'auth' => 'required'
        ]);

        if ($request->status == "OK"){
            Payment::query()->where('auth_code',$request->auth)->update([
                'ref_code' => $request->refid,
                'status' => 2
            ]);

            return 'pay is successfully';
        }else{
            Payment::query()->where('auth_code',$request->auth)->update([
                'status' => 3
            ]);

            return 'pay is not successfully';
        }
    }
}
