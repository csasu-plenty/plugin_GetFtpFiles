<?php

namespace GetFtpFiles\Crons;

use Plenty\Modules\Cron\Contracts\CronHandler;
use Plenty\Plugin\Log\Loggable;
use Throwable;

class TestCron extends CronHandler
{
    use Loggable;

    public function handle()
    {

    }
}
