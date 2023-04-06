<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function profile()
    {
        return view('admin.user_management.profile');
    }

    public function changePasswordForm()
    {
        return view('admin.user_management.change_password');
    }

    public function updatePassword(ChangePasswordRequest $request)
    {
            auth()->user()->update(['password' => Hash::make($request->new_password)]);

            return redirect()->back()->with('success', 'Password changed successfully');
    }

    public function updateProfile(Request $request)
    {
        $user = \auth()->user();
        $validator = Validator::make($request->all(), [
            'phone' => 'required|unique:users,phone,'.$user->id,
            'email' => 'required|unique:users,email,'.$user->id,
            'name' => 'required',
        ]);
        $user->fill($validator->validated())->save();

        return redirect()->back()->with('success', 'User Profile Updated Successfully');
    }
}
