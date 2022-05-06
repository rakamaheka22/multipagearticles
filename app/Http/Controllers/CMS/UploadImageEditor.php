<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Services\ImageUpload\ImageUploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadImageEditor extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $imageUploader = new ImageUploader(
            $request->file('file'),
            'uploads/'.now()->year.'/'.now()->month.'/'
        );
        $imageUploader->saveImage();

        return response()->json([
            'location' => Storage::url($imageUploader->filePath),
        ]);
    }
}
