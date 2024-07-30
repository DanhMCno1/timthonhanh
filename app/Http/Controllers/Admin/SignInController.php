<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SignInRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SignInController extends Controller
{
    public function create(): View
    {
        return view('admins.signin');
    }

    public function store(SignInRequest $request)
    {
        if (auth('admin')->attempt($request->only('username', 'password'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('admin.orders.index'))
                ->with('success', 'Đăng nhập thành công.');
        }

        return back()->withInput($request->only('username'))
            ->with('error', 'Sai thông tin đăng nhập.');
    }
}
