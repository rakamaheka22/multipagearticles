<?php

namespace App\Services\ImageUpload;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageUploader
{
    /** @var \Illuminate\Http\UploadedFile */
    protected $uploadedFile;

    /** @var string */
    public $filePath;

    /** @var string */
    protected $disk;

    /**
     * Create a new ImageUploader instance
     *
     * @param  \Illuminate\Http\UploadedFile  $uploadedFile
     * @param  string  $directory
     * @param  string|null  $disk
     * @return void
     */
    public function __construct(UploadedFile $uploadedFile, string $directory, string $disk = null)
    {
        $this->uploadedFile = $uploadedFile;

        $fileNameGenerator = new FileNameGenerator(
            pathinfo($this->uploadedFile->getClientOriginalName(), PATHINFO_FILENAME),
            $this->uploadedFile->extension()
        );
        $this->filePath = $directory.$fileNameGenerator->generateFileName();

        $this->disk = $disk;
    }

    public function saveImage(): void
    {
        /** @var string */
        $file = $this->uploadedFile->get();

        Storage::disk($this->disk)->put($this->filePath, $file);
    }
}
