<?php

namespace App\Services\FileManager;

use Maatwebsite\Excel\Excel;
use App\Contracts\Services\FileManager\FileReader;

class CsvReader implements FileReader
{
    /**
     * @var
     */
    protected $excel;

    /**
     * CsvReader constructor.
     *
     * @param $excel
     */
    public function __construct(Excel $excel)
    {
        $this->excel = $excel;
    }

    /**
     * @param $file
     */
    public function read($file)
    {
        $this->excel->load($file)->get();
    }
}