<?php

namespace GetFtpFiles\Controllers;

use GetFtpFiles\Services\ReadFilesService;
use Plenty\Plugin\Controller;
use Plenty\Plugin\Log\Loggable;

class TestController extends Controller
{
    use Loggable;

    public function importImages(ReadFilesService $filesService)
    {
        return $filesService->processFtpFiles();
    }

}
