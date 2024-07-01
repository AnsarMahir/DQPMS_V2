<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function showUploadForm()
    {
        return view('file-upload');
    }

    public function uploadFile(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png,bmp,pdf,pptx,ppt,docx|max:20480',
        ]);

        $path = $request->file('file')->store('uploads');

        return back()->with('success', 'File uploaded successfully.')->with('path', $path);
    }

    public function downloadFile($filename)
    {
        $file = Storage::path('uploads/' . $filename);

        if (file_exists($file)) {
            return response()->download($file);
        } else {
            abort(404, 'File not found.');
        }
    }
}
