<?php

namespace Tests\Unit\Jobs\UserManager;

use Tests\TestCase;
use App\UserManager\Users\User;
use App\UserManager\Users\Account;
use App\Jobs\UserManager\RegisterUser;
use App\UserManager\Users\UserRepository;
use App\Events\UserManager\UserWasRegistered;
use App\Exceptions\UserEmailAlreadyExistsException;
use App\Http\Requests\UserManager\RegisterUserRequest;

/**
 * @group usermanager
 */
class RegisterUserTest extends TestCase
{
    /** @test */
    function it_registers_a_new_user()
    {
        $this->expectsEvents(UserWasRegistered::class);
        $request = $this->mock(RegisterUserRequest::class);
        $request->shouldReceive('get');
        $request->shouldReceive('all');
        $repository = $this->mock(UserRepository::class);
        $repository->shouldReceive('findByEmail');
        $account = $this->mock(Account::class);
        $account->shouldReceive('create')->andReturn($this->mock(User::class));

        $registrar = new RegisterUser($request, $repository);
        $registrar->handle($account);
    }

    /** @test */
    function it_throws_an_exception_when_a_user_with_the_same_email_exists()
    {
        $this->expectException(UserEmailAlreadyExistsException::class);

        $repository = $this->mock(UserRepository::class);
        $repository->shouldReceive('findByEmail')->andReturn(new User());

        $registrar = new RegisterUser($this->mock(RegisterUserRequest::class), $repository);
        $registrar->isRegisteredEmail('test@test.com');
    }
}
