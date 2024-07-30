<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\SignInRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SignInController extends Controller
{
    public function signin()
    {
        return view('users.signin');
    }

    public function submitSignin(SignInRequest $request)
    {
        // Thu thập thông tin đăng nhập
        $credentials = [
            'phone' => $request->phone_signin,
            'password' => $request->password_signin,
        ];

        $remember = $request->has('remember');
        // Thử đăng nhập
        if (Auth::attempt($credentials, $remember)) {
            // Đăng nhập thành công
            $request->session()->regenerate();
            return response()->json([
                'success' => true,
                'redirect_url' => route('user.home'),
            ]);
        }

        // Đăng nhập thất bại
        return response()->json([
            'success' => false,
            'message' => 'Thông tin đăng nhập không đúng.',
        ], 401);
    }
}
