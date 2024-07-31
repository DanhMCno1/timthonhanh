<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
class QRController extends Controller
{
    public function index(): View
    {
        if (Auth::guard('staff')->check()) {
            $staff = Auth::guard('staff')->user();

            return view('staffs.qr', [
                'referral_code' => $staff->referral_code
            ]);
        } else {
            abort(403, 'Unauthorized action.');
        }
    }
}
