<?php

namespace GetFtpFiles\Crons;

use GetFtpFiles\Configuration\PluginConfiguration;
use GetFtpFiles\Services\ReadFilesService;
use Plenty\Modules\Cron\Contracts\CronHandler;
//use Plenty\Plugin\Log\Loggable;
use Throwable;

class ProcessFtpFilesCron extends CronHandler
{
    //use Loggable;

    /**
     * @param ReadFilesService $readFilesService
     * @return void
     */
    public function handle(ReadFilesService $readFilesService)
    {
//        $this->getLogger(__METHOD__)
//            ->info(PluginConfiguration::PLUGIN_NAME . '::general.cronStarted');

        $response = $readFilesService->processFtpFiles();

//        $this->getLogger(__METHOD__)
//            ->info(PluginConfiguration::PLUGIN_NAME . '::general.cronEnded',
//                [
//                    'message'  => $response
//                ]
//            );
    }
}
