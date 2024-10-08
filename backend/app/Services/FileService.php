<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileService
{
    public static function store(UploadedFile $file, $disk = 'public')
    {
        $filename =  hash('sha256', now() . $file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
        
        if (env('APP_ENV') == 'local') {
            $image = Storage::disk('public')->putFileAs('/images', $file, $filename);
        } else if (env('APP_ENV') == 'production') {
            $image = Storage::disk()->putFileAs('/images', $file, $filename);
        }

        return $image;
    }

    public static function delete($path)
    {
        if (env('APP_ENV') == 'local') {
            Storage::disk('public')->delete($path);
        } elseif (env('APP_ENV') == 'production') {
            Storage::disk('r2')->delete($path);
        }
    }

    public static function getUrl($path, $disk='public')
    {
        if (env('APP_ENV') == 'local') {
            return Storage::disk($disk)->url($path);
        } elseif (env('APP_ENV') == 'production') {
            return Storage::disk('r2')->url($path);
        }
    }
}
