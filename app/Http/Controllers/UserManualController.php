<?php

namespace App\Http\Controllers;

use App\Models\UserManual;
use App\Http\Requests\StoreUserManualRequest;
use App\Http\Requests\UpdateUserManualRequest;
use Illuminate\Support\Facades\Storage;

class UserManualController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $manuals = UserManual::query()->latest()->get();
        return view('admin.settings.user_manuals.index', [
            'manuals' => $manuals,
        ]);
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
        $data = $request->validated();

        $id = $request->input('id');

        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $dir = 'public/user_manuals';
            $path = $file->store($dir);
            $data['file'] = str_replace($dir, '', $path);
        }

        if ($id) {
            $manual = UserManual::query()->findOrFail($id);
            $manual->update($data);
        } else {
            $data['slug'] = str_slug($data['title']) . '-' . uniqid();
            $manual = UserManual::query()->create($data);
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'User manual saved successfully.',
                'manual' => $manual,
            ]);
        }

        return redirect()->back()->with('success', 'User manual saved successfully.');
    }

    public function download($slug)
    {
        $manual = UserManual::query()->where('slug', $slug)->firstOrFail();
        $path = 'public/user_manuals' . $manual->file;
        if (!Storage::exists($path)) {
            abort(404, "File not found");
        }
        return Storage::download($path);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserManual  $userManual
     * @return UserManual
     */
    public function show(UserManual $userManual)
    {
        return $userManual;
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

        $user = UserManual::findOrFail($request->input('UserManualId'));
        $user->title=$request->title;
        $user->description=$request->description;

        if ($request->hasFile('file')) {
            $destination = 'public/user_manuals' . $user->photo;
            if (Storage::exists($destination)) {
                Storage::delete($destination);
            }
            $dir = 'public/user_manuals';
            $path = $request->file('file')->store($dir);
            $file = str_replace($dir, '', $path);
            $user->file = $file;
        }
//        return $user;
        $user->save();
        return redirect()->back()->with('success', 'User manual updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserManual  $userManual
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(UserManual $userManual,$id)
    {
        $certificate = UserManual::find($id);
        $certificate->delete();
        return redirect()->back()->with('success','User manual Deleted Successfully');

    }

}
