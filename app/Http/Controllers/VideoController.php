<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function showUploadForm()
    {
        return view('video-upload');
    }

    public function uploadVideo(Request $request)
    {
        $request->validate([
            'video' => 'required|mimes:mp4,avi,mkv|max:51200', // 50MB max
        ]);

        $path = $request->file('video')->store('videos');

        return back()->with('success', 'Video uploaded successfully.')->with('path', $path);
    }

    public function downloadVideo($filename)
    {
        $file = Storage::path('videos/' . $filename);

        if (file_exists($file)) {
            return response()->download($file);
        } else {
            abort(404, 'File not found.');
        }
    }
}
