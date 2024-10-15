<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileService
{
    public static function store(UploadedFile $file, $disk = 'public')
    {
        $filename =  hash('sha256', now() . $file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();

        return  Storage::disk($disk)->putFileAs('/images', $file, $filename);
    }

    public static function delete($path, $disk = 'public')
    {
        Storage::disk($disk)->delete($path);
    }

    public static function getUrl($path, $disk = 'public')
    {
        return Storage::disk($disk)->url($path);
    }
}
