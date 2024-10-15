<?php

namespace App\Http\Controllers;

use App\Imports\ItemImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ImportItemController extends Controller
{
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:csv,xls,xlsx',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $file = $request->file('file');
        $filename = $file->getClientOriginalName();
        $path = $file->storeAs('files', $filename, 'public');

        Excel::queueImport(new ItemImport, $path, 'public');

        return response()->json([
            'message' => 'success import item',
        ]);
    }
}
