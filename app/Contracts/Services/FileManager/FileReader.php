<?php

namespace App\Contracts\Services\FileManager;

interface FileReader {
    public function read($file);
}