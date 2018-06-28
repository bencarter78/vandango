<?php

namespace App\Services\FileManager;

abstract class FileManager
{

    /**
     * The fully qualified path to the file
     *
     * @var string
     */
    protected $path = '';

    /**
     * The fully qualified URL to the file
     *
     * @var string
     */
    protected $url = '';

    /**
     * The relative path to the file
     *
     * @var string
     */
    protected $fileLocation = '';

    /**
     * @var string
     */
    protected $filename;

    /**
     * @var string
     */
    protected $fileExtension;

    /**
     * @var string
     */
    protected $outputDir;

    /**
     * @param $filename
     */
    public function setFileLocation($filename)
    {
        $this->fileLocation = $this->exportDir . camel_case($filename) . '_' . date('Y-m-d') . $this->fileExt;
        $this->setPath($this->fileLocation);
        $this->setUrl($this->fileLocation);
    }

    /**
     * @return string
     */
    public function setPath()
    {
        $this->path = public_path() . $this->fileLocation;
    }

    /**
     * @return string
     */
    public function setUrl()
    {
        $this->url = asset($this->fileLocation);
    }

    /**
     * @return string
     */
    public function getFileExtension()
    {
        return $this->fileExtension;
    }

    /**
     * @return mixed
     */
    public function getFilename()
    {
        return $this->filename . '_' . time();
    }

    /**
     * @param mixed $filename
     */
    public function setFilename($filename)
    {
        if (isset($filename['title'])) {
            $this->filename = $filename['title'];
        }
    }

    /**
     * @return string
     */
    public function getOutputDir()
    {
        return $this->outputDir;
    }

} 