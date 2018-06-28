<?php

namespace Tests\Feature\Api\V1\Cpd;

use App\Cpd\User;
use Tests\TestCase;
use App\Cpd\Certificate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group cpd
 */
class CertificateControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_saves_a_users_certificate()
    {
        $user = factory(User::class)->create();

        $response = $this->json('POST', route('api.cpd.certificates.store'), [
            'user_id' => $user->id,
            'title' => 'Example Title',
            'path' => 'example-file.jpg',
        ]);

        $certificate = Certificate::first();
        $response->assertStatus(Response::HTTP_OK);
        $this->assertEquals(1, $user->certificates->count());
        $this->assertEquals('Example Title', $certificate->title);
        $this->assertEquals('example-file.jpg', $certificate->path);
    }

    /** @test */
    public function a_user_id_is_required()
    {
        $response = $this->json('POST', route('api.cpd.certificates.store'));

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertHasError('user_id');
    }

    /** @test */
    public function a_title_is_required()
    {
        $response = $this->json('POST', route('api.cpd.certificates.store'));

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertHasError('title');
    }

    /** @test */
    public function a_path_is_required()
    {
        $response = $this->json('POST', route('api.cpd.certificates.store'));

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertHasError('path');
    }
}
