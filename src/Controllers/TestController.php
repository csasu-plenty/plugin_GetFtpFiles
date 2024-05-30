<?php

namespace GetFtpFiles\Controllers;

use Plenty\Plugin\Controller;
use Plenty\Plugin\Log\Loggable;
use GetFtpFiles\Crons\TestCron;

class TestController extends Controller
{
    use Loggable;


    public function testMethod()
    {
        $test = pluginApp(TestCron::class);
        return 1;
    }
}
