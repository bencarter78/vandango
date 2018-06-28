<?php

namespace Tests\Unit\UserManager\Users;

use Tests\TestModel;
use App\UserManager\Users\Guest;

/**
 * @group usermanager
 */
class GuestTest extends TestModel
{
    protected $model = Guest::class;

    protected $fillable = ['email', 'first_name', 'surname', 'company'];

    /** @test */
    public function it_formats_the_first_name()
    {
        $user = new Guest();
        $user->first_name = 'test';
        $this->assertEquals('Test', $user->first_name);
    }

    /** @test */
    public function it_formats_the_surname()
    {
        $user = new Guest();
        $user->surname = 'test';
        $this->assertEquals('Test', $user->surname);
    }
}
