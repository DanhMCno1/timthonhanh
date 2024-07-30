<?php

namespace App\Http\Controllers\Staff\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\Auth\SignInRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function Laravel\Prompts\error;

class SignInController extends Controller
{
    public function create()
    {
        return view('staffs.auth.signin');
    }

    public function store(SignInRequest $request)
    {
        if (Auth::guard('staff')->attempt($request->only('phone', 'password'), $request->boolean('remember'))) {
            $request->session()->regenerate();
            $staff = Auth::guard('staff')->user();
            if ($staff->status == 'block' || $staff->status == 'foreverblock') {
                Auth::guard('staff')->logout();
                return back()->with('error', 'Tài khoản này đang bị khóa, vui lòng liên hệ tổng đài để được hỗ trợ.');
            }
            return redirect()->intended(route('staff.home'))
                ->with('success', 'Đăng nhập thành công.');
        }

        return back()->withInput($request->only('phone', 'remember'))
            ->with('error', 'Sai thông tin đăng nhập.');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('staff')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('staff.signin.create');
    }
}
