<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\StreamedResponse;

trait UploadFileTrait
{
    public function uploadFile($file, $path)
    {
        $uuid = Str::slug(Str::uuid(), '');
        $extension = $file->extension();
        $name = "$uuid.$extension";
        return Storage::putFileAS($path, $file, $name);
    }

    /**
     * @param $path
     * @return StreamedResponse
     */
    public function downloadFile($path)
    {
        //download file
        return Storage::download($path);
    }

    public function deleteFile($path)
    {
        if (Storage::exists($path)) {
            Storage::delete($path);
        }
    }
}
