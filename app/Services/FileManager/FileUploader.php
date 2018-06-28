<?php

namespace App\Services\FileManager;

use App\Exceptions\FileFormatNotAllowedException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader extends FileManager
{
    /**
     * @var array
     */
    protected $allowedExtensions = ['csv', 'pdf', 'doc', 'docx'];

    /**
     * @var
     */
    protected $uploadDir;

    /**
     * @var
     */
    protected $filePrefix;

    /**
     * @var
     */
    protected $filename = null;

    /**
     * @param $file
     * @return string
     * @throws FileFormatNotAllowedException
     */
    public function upload(UploadedFile $file)
    {
        if ($this->canBeUploaded($file)) {
            $this->setFilename($file->getClientOriginalName());
            $file->move($this->getUploadDir(), $this->getFilename());

            return $this->getUploadDir() . $this->getFilename();
        }
    }

    /**
     * @param $file
     * @return bool
     * @throws FileFormatNotAllowedException
     */
    public function canBeUploaded($file)
    {
        if ( ! in_array($file->getClientOriginalExtension(), $this->allowedExtensions)) {
            throw new FileFormatNotAllowedException('This file format is not allowed.');
        }

        return true;
    }

    /**
     * @return mixed
     */
    public function getFilePrefix()
    {
        return $this->filePrefix;
    }

    /**
     * @param mixed $filePrefix
     * @return $this
     */
    public function setFilePrefix($filePrefix)
    {
        $this->filePrefix = $filePrefix;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFilename()
    {
        return str_replace(" ", '-', $this->filename);
    }

    /**
     * @param mixed $filename
     * @return $this|void
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * @return array
     */
    public function getAllowedExtensions()
    {
        return $this->allowedExtensions;
    }

    /**
     * @param array $allowedExtensions
     * @return $this
     */
    public function setAllowedExtensions($allowedExtensions)
    {
        $this->allowedExtensions = $allowedExtensions;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUploadDir()
    {
        return $this->uploadDir;
    }

    /**
     * @param mixed $uploadDir
     * @return $this
     */
    public function setUploadDir($uploadDir)
    {
        $this->uploadDir = $uploadDir;

        return $this;
    }

} 