<?php

namespace GetFtpFiles\Crons;

use GetFtpFiles\Services\ReadFilesService;
use Plenty\Modules\Cron\Contracts\CronHandler;
use Plenty\Plugin\Log\Loggable;
use Throwable;

class ProcessFtpFilesCron extends CronHandler
{
    use Loggable;

    public function handle(ReadFilesService $readFilesService)
    {
        //get files from FTP
        $files = $readFilesService->getFtpFileNames();

        //process files from FTP
        foreach ($files as $file){
            //process current file
        }
    }
}
