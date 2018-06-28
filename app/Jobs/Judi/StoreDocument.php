<?php

namespace App\Jobs\Judi;

use Illuminate\Http\UploadedFile;

class StoreDocument
{
    /**
     * @var
     */
    private $id;

    /**
     * @var
     */
    private $file;

    /**
     * Create a new job instance.
     *
     * @param $id
     * @param $file
     */
    public function __construct($id, UploadedFile $file)
    {
        $this->id = $id;
        $this->file = $file;
    }

    public function handle()
    {
        return $this->file->storeAs(
            config('vandango.judi.paths.summaries') . $this->id . '/' . time(),
            $this->file->getClientOriginalName(),
            config('vandango.judi.disk')
        );
    }
}
