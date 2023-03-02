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
        return response()->json([
            'action' => 1,
            'token' => auth()->user()->createToken('API Token')->plainTextToken,
            'message' => 'Login Successful',
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->role,
            'permissions' => $user->permissions,
            'operator_name' => $user->operator->name ?? null,
            'operator_id' => $user->operator->id ?? null,
            'operating_area_name' => $user->operationArea->name ?? null,
            'operating_area_id' => $user->operationArea->id ?? null,
            'id'=>$user->id
        ]);
    }
}
