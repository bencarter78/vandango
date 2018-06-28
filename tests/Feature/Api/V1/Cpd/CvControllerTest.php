<?php

namespace Tests\Feature\Api\V1\Cpd;

use App\Cpd\User;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/** 
 * @group cpd
 */
class CvControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_saves_the_users_cv()
    {
        $user = factory(User::class)->create();

        $response = $this->json('PATCH', route('api.cpd.cv.update'), [
            'user_id' => $user->id,
            'path' => 'example-file.jpg',
        ]);

        $response->assertStatus(Response::HTTP_OK);
        $this->assertNotNull($user->cv->path);
    }

    /** @test */
    public function a_user_id_is_required()
    {
        $response = $this->json('PATCH', route('api.cpd.cv.update'), [
            'path' => 'example-file.jpg',
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
