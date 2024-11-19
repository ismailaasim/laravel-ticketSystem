<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function download($filename)
    {
        // Assuming the files are stored in storage/app/public/attachments/
        $path = storage_path('app/public/attachments/' . $filename);

        if (!Storage::exists($path)) {
            return abort(404, 'File not found');
        }

        return response()->download($path);
    }
}
