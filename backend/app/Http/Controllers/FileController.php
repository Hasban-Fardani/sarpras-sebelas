<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * @group File Management
 *
 * API endpoints for get files from R2
 */
class FileController extends Controller
{
    public function __invoke(Request $request, $path)
    {
        $disk = Storage::disk();
        if ($request->disk) {
            $disk = Storage::disk($request->disk);
        }

        // Check if the file exists in R2
        if (!$disk->exists($path)) {
            abort(404); // Return a 404 if the file does not exist
        }

        // Get the file from disk
        $fileContent = $disk->get($path);

        // Determine the file's mime type
        $mimeType = $disk->mimeType($path);

        // Return the file as a streamed response with the correct content type
        return response($fileContent, 200)
            ->header('Content-Type', $mimeType)
            ->header('Content-Disposition', 'inline; filename="' . basename($path) . '"');
    }
}
