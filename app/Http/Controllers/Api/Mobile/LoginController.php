<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials))
            return response()->json([
                'action' => 0,
                'message' => 'Invalid Credentials'
            ]);
        $user = $request->user();
//        if ($user->can('Make Billing')) {
            return response()->json([
                'action' => 1,
                'token' => auth()->user()->createToken('API Token')->plainTextToken,
                'message' => 'Login Successful',
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'permissions' => $user->permissions,
                'operator_name' => $user->operator->name ?? null,
                'operator_id' => $user->operator->id ?? null,
                'operating_area_name' => $user->operationArea->name ?? null,
                'operating_area_id' => $user->operationArea->id ?? null,
                'id' => $user->id
            ]);
//        } else {
//            return response()->json([
//                'action' => 0,
//                'message' => 'You are not authorized to make Billing'
//            ]);
//        }

    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'action' => 1,
            'message' => 'Logout Successful'
        ]);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
        ]);
        $user = $request->user();
        if (!\Hash::check($request->old_password, $user->password)) {
            return response()->json([
                'action' => 0,
                'message' => 'Old password does not match'
            ]);
        }
        $user->password = \Hash::make($request->new_password);
        $user->save();
        return response()->json([
            'action' => 1,
            'message' => 'Password changed successfully'
        ]);
    }
}
