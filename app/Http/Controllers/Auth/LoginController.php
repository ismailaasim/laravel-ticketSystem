<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login()
    {
        return view("auth.login");
    }
    public function loginUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ]);
        }
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $request->session()->put('loginId', $user->id);
                $request->session()->put('loginURole', $user->role);
                $request->session()->put('loginUbranch', $user->branch);
                return response()->json([
                    'success' => true,
                    'message' => 'Login Successful',
                    'redirectUrl' => route('dashboard')
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Password Mismatch'
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'This email is not registered'
            ]);
        }
    }
}
