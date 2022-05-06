<?php

namespace App\Services\ImageProcessor;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageProcessor
{
    /** @var ImageManipulator */
    protected $manipulator;

    /** @var string */
    protected $directory = 'images/';

    /** @var string */
    protected $fileName;

    /** @var string */
    protected $filePath;

    /** @var string */
    protected $oldFilePath;

    /** @var string */
    protected $disk;

    /**
     * Create a new ImageProcessor instance
     *
     * @param \Illuminate\Http\UploadedFile  $uploadedFile
     * @return void
     */
    public function __construct(UploadedFile $uploadedFile, string $fileName, string $disk = null, string $oldFilePath = null)
    {
        $this->manipulator = new ImageManipulator($uploadedFile);

        $this->fileName = now()->timestamp.'-'.Str::slug($fileName).'.'.strtolower($uploadedFile->extension());
        $this->filePath = $this->directory.$this->fileName;
        $this->oldFilePath = $oldFilePath;
        $this->disk = $disk;
    }

    public static function new(UploadedFile $uploadedFile, string $fileName, string $disk = null, string $oldFilePath = null)
    {
        return new static($uploadedFile, $fileName, $disk, $oldFilePath);
    }

    protected function handle(): void
    {
        $this->upload();
    }

    protected function complete(): void
    {
        $this->manipulator->destroy();
        $this->deleteOldFile();
    }

    /**
     * @return mixed
     */
    protected function thenReturn()
    {
        return $this->filePath;
    }

    /**
     * @return mixed
     */
    public function process()
    {
        $this->handle();
        $this->complete();

        return $this->thenReturn();
    }

    protected function upload(): void
    {
        Storage::disk($this->disk)->put(
            $this->filePath,
            Storage::disk('local')->get($this->manipulator->filePath)
        );
    }

    protected function deleteOldFile(): void
    {
        if ($this->oldFilePath) {
            Storage::disk($this->disk)->delete($this->oldFilePath);
        }
    }
}
