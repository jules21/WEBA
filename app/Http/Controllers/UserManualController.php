<?php

namespace App\Http\Controllers;

use App\Models\UserManual;
use App\Http\Requests\StoreUserManualRequest;
use App\Http\Requests\UpdateUserManualRequest;

class UserManualController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $userManuals = UserManual::query()->orderBy('id','DESC')->get();
        return view('admin.settings.user_manuals.index',compact('userManuals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserManualRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreUserManualRequest $request)
    {
        $userManual = new UserManual();
        $userManual->title=$request->title;
        $userManual->description=$request->description;
        $userManual->slug='slug';
        $userManual->save();
        return redirect()->back()->with('success','User Manual created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserManual  $userManual
     * @return \Illuminate\Http\Response
     */
    public function show(UserManual $userManual)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserManual  $userManual
     * @return \Illuminate\Http\Response
     */
    public function edit(UserManual $userManual)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserManualRequest  $request
     * @param  \App\Models\UserManual  $userManual
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateUserManualRequest $request, UserManual $userManual)
    {
        $userManual = UserManual::findOrFail($request->input('UserManualId'));
        $userManual->title=$request->title;
        $userManual->description=$request->description;
        $userManual->slug='slug';
        $userManual->save();
        return redirect()->back()->with('success','User Manual created Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserManual  $userManual
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(UserManual $userManual,$id)
    {
        try {
            $userManual = UserManual::find($id);
            $userManual->delete();
            return redirect()->back()->with('success','User Manual deleted Successfully');
        }catch (\Exception $exception){
            info($exception);{
                return redirect()->back()->with('error','User Manual can not be deleted');
            }
        }
    }

}
