<?php

namespace App\Http\Controllers;

use App\Models\UserManual;
use App\Http\Requests\StoreUserManualRequest;
use App\Http\Requests\UpdateUserManualRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class UserManualController extends Controller
{

    public function index()
    {
        $manuals = UserManual::query()->latest()->get();
        return view('admin.settings.user_manuals.index', [
            'manuals' => $manuals,
        ]);
    }


    public function store(StoreUserManualRequest $request)
    {
        $data = $request->validated();

        $id = $request->input('id');

        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $dir = UserManual::USER_MANUALS_PATH;
            $path = $file->store($dir);
            $data['file'] = str_replace($dir, '', $path);
        }

        if ($id) {
            $manual = UserManual::query()->findOrFail($id);
            $manual->update($data);
        } else {
            $data['slug'] = str_slug($data['title']) . '_' . uniqid();
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
        $path = UserManual::USER_MANUALS_PATH . $manual->file;
        if (!Storage::exists($path)) {
            abort(404, "File not found");
        }
        return Storage::download($path);
    }

    /**
     * Display the specified resource.
     *
     * @param UserManual $userManual
     * @return UserManual
     */
    public function show(UserManual $userManual)
    {
        return $userManual;
    }

    public function update(UpdateUserManualRequest $request, UserManual $userManual)
    {

        $user = UserManual::findOrFail($request->input('UserManualId'));
        $user->title = $request->title;
        $user->description = $request->description;

        if ($request->hasFile('file')) {
            $destination = UserManual::USER_MANUALS_PATH . $user->photo;
            if (Storage::exists($destination)) {
                Storage::delete($destination);
            }
            $dir = UserManual::USER_MANUALS_PATH;
            $path = $request->file('file')->store($dir);
            $file = str_replace($dir, '', $path);
            $user->file = $file;
        }
        $user->save();
        return redirect()->back()->with('success', 'User manual updated successfully.');
    }


    public function destroy(UserManual $userManual, $id)
    {
        $certificate = UserManual::find($id);
        $certificate->delete();
        return redirect()->back()->with('success', 'User manual Deleted Successfully');

    }

}
