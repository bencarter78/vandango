<?php

namespace Tests;

use Artisan;
use Mockery;
use PHPUnit\Framework\Assert;
use Tests\Traits\UserTypes;
use Tests\Traits\UserManager;
use Tests\Traits\CreatesApplication;
use Illuminate\Foundation\Testing\TestResponse;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class TestCase extends BaseTestCase
{
    use CreatesApplication, UserTypes, UserManager;

    public function setUp()
    {
        parent::setUp();

        TestResponse::macro('data', function ($key) {
            return is_array($this->original) ? $this->original[$key] : $this->original->getData()[$key];
        });

        TestResponse::macro('assertHasError', function ($key) {
            return Assert::assertTrue(in_array($key, array_keys($this->original)));
        });

        TestResponse::macro('assertHasErrors', function ($keys) {
            return Assert::assertEquals(array_keys($this->original), $keys);
        });

        EloquentCollection::macro('assertContains', function ($value) {
            Assert::assertTrue($this->contains($value), "Failed asserting that the collection contains the specified value.");
        });

        EloquentCollection::macro('assertNotContains', function ($value) {
            Assert::assertFalse($this->contains($value), "Failed asserting that the collection does not contain the specified value.");
        });

        EloquentCollection::macro('assertEquals', function ($items) {
            Assert::assertEquals(count($this), count($items));

            $this->zip($items)->each(function ($pair) {
                list($a, $b) = $pair;
                Assert::assertTrue($a->is($b), "$a is not $b");
            });
        });
    }

    /**
     * @param       $class
     * @param       $count
     * @param array $overrides
     * @return mixed
     */
    public function create($class, $count = 1, $overrides = [])
    {
        return $count > 1
            ? factory($class, $count)->create($overrides)
            : factory($class)->create($overrides);
    }

    /**
     * @param       $class
     * @param       $count
     * @param array $overrides
     * @return mixed
     */
    public function make($class, $count = 1, $overrides = [])
    {
        return $count > 1
            ? factory($class, $count)->make($overrides)
            : factory($class)->make($overrides);
    }

    /**
     * Set up the database
     */
    public function dbSetUp()
    {
        Artisan::call('migrate');
    }


    /**
     * Seed the database
     */
    public function dbSeed()
    {
        Artisan::call('db:seed');
    }

    /**
     * Resets the DB after the tests have run
     */
    public function dbReset()
    {
        Artisan::call('migrate:reset');
    }

    /**
     * @param $class
     * @return \Mockery\MockInterface
     */
    public function mock($class)
    {
        return Mockery::mock($class);
    }
}
