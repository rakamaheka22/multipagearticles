<?php

namespace App\Services\ImageUpload;

use Illuminate\Support\Str;

class FileNameGenerator
{
    /** @var string */
    protected string $fileName;

    /** @var string */
    protected string $fileExtension;

    /**
     * Create a new FileNameGenerator instance
     *
     * @param string  $fileName
     * @param string  $fileExtension
     * @return void
     */
    public function __construct(string $fileName, string $fileExtension)
    {
        $this->fileName = $fileName;
        $this->fileExtension = $fileExtension;
    }

    public function generateFileName(): string
    {
        return now()->timestamp.'-'.Str::slug($this->fileName).'.'.strtolower($this->fileExtension);
    }
}
