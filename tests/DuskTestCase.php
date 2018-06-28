<?php

namespace Tests;

use Tests\Traits\UserTypes;
use Tests\Traits\UserManager;
use Tests\Traits\CreatesApplication;
use Laravel\Dusk\TestCase as BaseTestCase;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;

abstract class DuskTestCase extends BaseTestCase
{
    use CreatesApplication, UserTypes, UserManager;

    /**
     * Prepare for Dusk test execution.
     *
     * @beforeClass
     * @return void
     */
    public static function prepare()
    {
        static::startChromeDriver();
    }

    /**
     * Create the RemoteWebDriver instance.
     *
     * @return \Facebook\WebDriver\Remote\RemoteWebDriver
     */
    protected function driver()
    {
        return RemoteWebDriver::create(
            'http://localhost:9515', DesiredCapabilities::chrome()
        );
    }

    /**
     * @param       $class
     * @param       $count
     * @param array $atts
     * @return mixed
     */
    public function create($class, $count = 1, $atts = [])
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
}
