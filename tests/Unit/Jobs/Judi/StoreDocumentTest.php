<?php

namespace Tests\Unit\Jobs\Judi;

use Tests\TestCase;
use App\Jobs\Judi\StoreDocument;
use Illuminate\Http\UploadedFile;

/**
 * @group judi
 */
class StoreDocumentTest extends TestCase
{
    /** @test */
    public function it_returns_the_path_of_an_uploaded_document()
    {
        $file = $this->mock(UploadedFile::class);
        $file->shouldReceive('getClientOriginalName');
        $file->shouldReceive('storeAs')->once()->andReturn('my-filepath.txt');
        (new StoreDocument(1, $file))->handle();
    }
}
