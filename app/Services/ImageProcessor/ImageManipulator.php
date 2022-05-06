<?php

namespace App\Services\ImageProcessor;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

class ImageManipulator
{
    /** @var UploadedFile */
    protected $uploadedFile;

    /** @var string */
    protected $directory;

    /** @var string */
    protected $fileName;

    /** @var string */
    protected $backupFilePath;

    /** @var string */
    public $filePath;

    /** @var string */
    public $localFilePath;

    /**
     * Create a new ImageManipulator instance
     *
     * @param \Illuminate\Http\UploadedFile  $uploadedFile
     * @return void
     */
    public function __construct(UploadedFile $uploadedFile)
    {
        $this->uploadedFile = $uploadedFile;

        $this->directory = 'image-processor/'.now()->timestamp;
        $this->fileName = pathinfo($this->uploadedFile->getClientOriginalName(), PATHINFO_FILENAME).'.'.$uploadedFile->clientExtension();
        $this->filePath = $this->uploadedFile->storeAs($this->directory, $this->fileName, ['disk' => 'local']);
        $this->localFilePath = storage_path("app/{$this->filePath}");
    }

    public function backup(): void
    {
        $this->backupFilePath = $this->directory.'backup/'.$this->fileName;

        Storage::disk('local')->copy($this->filePath, $this->backupFilePath);
    }

    public function restore(): void
    {
        if ($this->backupFilePath) {
            Storage::disk('local')->copy($this->backupFilePath, $this->filePath);

            Storage::disk('local')->delete($this->backupFilePath);

            $this->backupFilePath = null;
        }
    }

    public function optimize(): void
    {
        ImageOptimizer::optimize($this->localFilePath);
    }

    public function resize(int $width, int $height): void
    {
        $mime = getimagesize($this->localFilePath);

        if ($mime['mime'] =='image/png') {
            $image = imagecreatefrompng($this->localFilePath);
        }

        if ($mime['mime'] =='image/jpg' || $mime['mime'] =='image/jpeg' || $mime['mime'] =='image/pjpeg') {
            $image = imagecreatefromjpeg($this->localFilePath);
        }

        $oldWidth = imageSX($image);
        $oldHeight = imageSY($image);

        // Landscape
        if ($oldWidth > $oldHeight) {
            $newWidth = $width;
            $newHeight = $oldHeight*($height/$oldWidth);
        }

        // Portrait
        if ($oldWidth < $oldHeight) {
            $newWidth = $oldWidth*($width/$oldHeight);
            $newHeight = $height;
        }

        // Square
        if ($oldWidth == $oldHeight) {
            $newWidth = $width;
            $newHeight = $height;
        }

        $resizedImage = imagecreatetruecolor($newWidth, $newHeight);

        imagecopyresampled($resizedImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $oldWidth, $oldHeight);

        if ($mime['mime']=='image/png') {
            imagepng($resizedImage, $this->localFilePath, 8);
        }
        if ($mime['mime']=='image/jpg' || $mime['mime']=='image/jpeg' || $mime['mime']=='image/pjpeg') {
            imagejpeg($resizedImage, $this->localFilePath, 80);
        }

        imagedestroy($resizedImage);
        imagedestroy($image);
    }

    public function destroy(): void
    {
        Storage::disk('local')->deleteDirectory($this->directory);
    }
}
