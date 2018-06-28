<?php

namespace App\Services\FileManager\PDF;

use Thujohn\Pdf\Pdf as ThujohnPdf;
use Illuminate\Contracts\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class Pdf extends ThujohnPdf
{
    /**
     * @var Filesystem
     */
    protected $file;

    /**
     * Pdf constructor.
     *
     * @param Filesystem $file
     */
    public function __construct(Filesystem $file)
    {
        $this->file = $file;
    }

    /**
     * @param $html
     * @param $filepath
     * @return bool
     */
    public function createFrom($html, $filepath)
    {
        $file = $this->file->put($filepath, $this->load($html, 'A4', 'portrait')->output());

        if ( ! $file) {
            throw new FileException('Could not create the PDF');
        }

        return $this->clear();
    }

}