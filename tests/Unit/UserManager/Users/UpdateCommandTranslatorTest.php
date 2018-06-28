<?php

namespace Tests\Unit\UserManager\Users;

use Tests\TestModel;
use App\Jobs\UserManager\UpdateUser;
use App\UserManager\Users\UpdateCommandTranslator;

/**
 * @group usermanager
 */
class UpdateCommandTranslatorTest extends TestModel
{
    /** @test */
    public function it_returns_the_correct_class()
    {
        $this->assertEquals(UpdateUser::class, UpdateCommandTranslator::translate('general'));
    }
}
