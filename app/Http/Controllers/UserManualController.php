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
use Spatie\TranslationLoader\LanguageLine;

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
        if ($id) {
            $manual = UserManual::query()->findOrFail($id);
        } else {
            $data['slug'] = str_slug($data['title']) . '_' . uniqid();
            $manual = new UserManual();
            $manual->slug = $data['slug'];
        }


        //file
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $dir = UserManual::USER_MANUALS_PATH;
            $path = $file->store($dir);
            $manual->file = str_replace($dir, '', $path);
        }
        //file kn
        if ($request->hasFile('file_kn')) {
            $file = $request->file('file_kn');

            $dir = UserManual::USER_MANUALS_PATH;
            $path = $file->store($dir);
            $manual->file_kn = str_replace($dir, '', $path);
        }

//
//        if ($request->ajax()) {
//            return response()->json([
//                'success' => true,
//                'message' => 'User manual saved successfully.',
//                'manual' => $manual,
//            ]);
//        }


        $timestamp = now()->timestamp;
        $identifier = uniqid();
        $id = "${identifier}_${timestamp}";
        $group = "manuals";

        $title = $request->title;
        $description = $request->description;

        $title_kn = $request->title_kn;
        $description_kn = $request->description_kn;

        $titleKey = "title_$id";

        LanguageLine::create(
            [
                'group' => $group,
                'key' => $titleKey,
                'text' => [
                    'kn' => $title_kn,
                    'en' => $title,
                ],
            ]
        );

        $descriptionKey = "description_$id";

        LanguageLine::create(
            [
                'group' => $group,
                'key' => $descriptionKey,
                'text' => [
                    'kn' => $description_kn,
                    'en' => $description,
                ],
            ]
        );

        $manual->title = "$group.$titleKey";
        $manual->description = "$group.$descriptionKey";

        $manual->save();





        return redirect()->back()->with('success', 'User manual saved successfully.');
    }

    public function download($slug)
    {
        $locale = app()->getLocale();
        if ($locale == 'kn') {
            $manual = UserManual::query()->where('slug', $slug)->firstOrFail();
            $path = UserManual::USER_MANUALS_PATH . $manual->file_kn;
            if (!Storage::exists($path)) {
                abort(404, "File not found");
            }
            return Storage::download($path);
        }
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

        //
        $user = UserManual::findOrFail($request->input('UserManualId'));

        $title = $request->title;
        $description = $request->description;

        $title_kn = $request->title_kn;
        $description_kn = $request->description_kn;

        $titleKey = \Str::after($user->title, '.');
        $descriptionKey = \Str::after($user->description, '.');

        $titleLine = LanguageLine::query()->where('key', $titleKey)->first();
        $descriptionLine = LanguageLine::query()->where('key', $descriptionKey)->first();

        $titleLine->text = [
            'kn' => $title_kn,
            'en' => $title,
        ];

        $descriptionLine->text = [
            'kn' => $description_kn,
            'en' => $description,
        ];

        $titleLine->save();
        $descriptionLine->save();
        //


        $user->for_admin = $request->for_admin;

        //file
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
        //file kn
        if ($request->hasFile('file_kn')) {
            $destination = UserManual::USER_MANUALS_PATH . $user->photo;
            if (Storage::exists($destination)) {
                Storage::delete($destination);
            }
            $dir = UserManual::USER_MANUALS_PATH;
            $path = $request->file('file_kn')->store($dir);
            $file = str_replace($dir, '', $path);
            $user->file_kn = $file;
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

    public function userManualForAdmins()
    {
        $manuals = UserManual::query()->where('for_admin', true)->get();

        return view('admin.user_management.user_manual', compact('manuals'));
    }

}
