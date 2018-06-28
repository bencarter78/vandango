<?php

namespace Tests\Unit\UserManager\Users;

use Carbon\Carbon;
use Tests\TestCase;
use App\UserManager\Users\User;
use App\UserManager\Users\Account;

/**
 * @group usermanager
 */
class AccountTest extends TestCase
{
    /** @test */
    function it_returns_the_user_when_an_account_is_created()
    {
        $user = $this->mock(User::class);
        $user->shouldReceive('create')->andReturn($user);
        $user->shouldReceive('meta->save');

        $account = new Account($user);

        $this->assertInstanceOf(User::class, $account->create([
            'email' => 'test.mctest@test.com',
            'first_name' => 'Test',
            'surname' => 'McTest',
            'tel' => '01234567890',
            'mob' => '07234567890',
            'start_date' => date('d/m/Y'),
        ]));
    }

    /** @test */
    function it_returns_a_valid_email_address()
    {
        $user = $this->mock(User::class);
        $account = new Account($user);
        $account->setData(['email' => 'test@test.com']);

        $this->assertEquals('test@test.com', $account->getEmail());
    }

    /**
     * @test
     * @expectedException App\Exceptions\UserAccountException
     */
    function it_throws_an_exception_when_the_email_address_is_invalid()
    {
        $account = new Account($this->mock(User::class));
        $account->setData(['email' => 'test.com']);
        $account->getEmail();
    }

    /** @test */
    function it_returns_the_users_username()
    {
        $user = $this->mock(User::class);
        $account = new Account($user);
        $account->setData(['email' => 'test.mctest@test.com']);

        $this->assertEquals('test.mctest', $account->getUsername());
    }

    /** @test */
    function it_returns_a_hashed_password()
    {
        $account = new Account($this->mock(User::class));
        $account->setData(['password' => 'password']);
        $this->assertTrue(password_verify('password', $account->getPassword()));
    }

    /** @test */
    function it_returns_a_hashed_password_when_no_password_has_been_provided()
    {
        $account = new Account($this->mock(User::class));
        $this->assertNotNull($account->getPassword());
    }

    /** @test */
    function it_returns_the_users_surname()
    {
        $account = new Account($this->mock(User::class));
        $account->setData(['surname' => 'McTest']);
        $this->assertEquals('McTest', $account->getSurname());
    }

    /**
     * @test
     * @expectedException App\Exceptions\UserAccountException
     */
    function it_throws_an_exception_when_no_last_name_or_surname_is_given()
    {
        $account = new Account($this->mock(User::class));
        $account->getSurname();
    }
    
    /** @test */
    function it_returns_a_carbon_object_of_the_start_date_given_as_a_string()
    {
        $account = new Account($this->mock(User::class));
        $account->setData(['start_date' => date('d/m/Y')]);
        $this->isInstanceOf(Carbon::class, $account->getStartDate());
    }

    /**  @test */
    function it_returns_the_start_date_as_a_carbon_object()
    {
        $account = new Account($this->mock(User::class));
        $account->setData(['start_date' => Carbon::now()]);
        $this->isInstanceOf(Carbon::class, $account->getStartDate());
    }

    /**
     * @test
     * @expectedException App\Exceptions\UserAccountException
     */
    function it_throws_an_exception_when_no_start_date_is_given()
    {
        $account = new Account($this->mock(User::class));
        $account->setData(['start_date' => null]);
        $account->getStartDate();
    }
}
