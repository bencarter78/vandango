<?php

namespace Tests\Feature\Api\V1;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\DatabaseTransactions;


class FileUploadControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
    	parent::setUp();
    	$this->dbSetUp();
    }

    /** @test */
    public function it_uploads_a_file()
    {
        Storage::fake('local');

        $response = $this->json('POST', route('api.uploads.store'), [
            'user_id' => $this->user()->id,
            'file' => UploadedFile::fake()->image('example-file.jpg'),
        ]);

        $response->assertStatus(Response::HTTP_CREATED);
        Storage::disk('local')->assertExists($response->data('data')['path']);
    }

    /** @test */
    public function a_user_id_is_required()
    {
        Storage::fake('local');

        $response = $this->json('POST', route('api.uploads.store'), [
            'file' => UploadedFile::fake()->image('example-file.jpg'),
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
