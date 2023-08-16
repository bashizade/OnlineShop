<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest\LoginRequest;
use App\Http\Requests\AuthRequest\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login_view()
    {

    }

    public function login(LoginRequest $request)
    {
        $validate_data = $request->validated();

        if (auth()->attempt(['email' => $validate_data['email'],'password' => $validate_data['password']])){
            if (auth()->user()->is_admin)
                return 'admin';

            return 'user';
        }else{
            return 'not yet user ';
        }
    }

    public function register_view()
    {

    }

    public function register(RegisterRequest $request)
    {
        $validate_data = $request->validated();

        $user = User::query()->create($validate_data);

        auth()->loginUsingId($user->id);

        return 'new user';
    }
}
