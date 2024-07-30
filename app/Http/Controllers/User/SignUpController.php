<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\SignUpRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SignUpController extends Controller
{
    public function signup()
    {
        return view('users.signup');
    }

    public function postSignup(SignUpRequest $request)
    {
        $data = $request->all();
        $user = new User();
        $user->name = $data['fullname'];
        $user->phone = $data['phone'];
        $user->password = Hash::make($data['password']);
        $user->province_id = $data['province_id'];
        $user->district_id = $data['district_id'];
        $user->ward_id = $data['ward_id'];
        $user->hamlet = $data['hamlet'];
        $user->save();
        
        return response()->json(['status' => 'successful']);
    }
}
