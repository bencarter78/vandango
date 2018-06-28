<?php

namespace Tests;

use Mockery;
use Tests\Traits\UserTypes;
use Tests\Traits\UserManager;
use Tests\Traits\CreatesApplication;
use Illuminate\Support\Facades\Artisan;
use Laravel\BrowserKitTesting\TestCase as BaseTestCase;

class BrowserKitTest extends BaseTestCase
{
    use CreatesApplication, UserTypes, UserManager;

    /**
     * @var string
     */
    protected $baseUrl = 'http://vandango.dev';

    /**
     * @param       $class
     * @param       $count
     * @param array $atts
     * @return mixed
     */
    public function create($class, $count, $atts = [])
    {
        return $count > 1
            ? factory($class, $count)->create($atts)
            : factory($class)->create($atts);
    }

    /**
     * @param       $class
     * @param       $count
     * @param array $atts
     * @return mixed
     */
    public function make($class, $count = 1, $atts = [])
    {
        return $count > 1
            ? factory($class, $count)->make($atts)
            : factory($class)->make($atts);
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
