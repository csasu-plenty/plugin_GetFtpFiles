<?php

namespace GetFtpFiles\Controllers;

use GetFtpFiles\Repositories\SettingRepository;
use GetFtpFiles\Services\ReadFilesService;
use Plenty\Plugin\Controller;
use Plenty\Plugin\Log\Loggable;
use GetFtpFiles\Crons\TestCron;

class TestController extends Controller
{
    use Loggable;


    public function testMethod(ReadFilesService $filesService)
    {
        //$test = pluginApp(TestCron::class);

        //F(szLuODs#yP


        //test data
        $settingsRepository = pluginApp(SettingRepository::class);
        try {
            $settingsRepository->save('ftp_hostname', 'ftp.sasu.ro');
            $settingsRepository->save('ftp_username', 'test@sasu.ro');
            $settingsRepository->save('ftp_password', 'F(szLuODs#yP');
            $settingsRepository->save('ftp_port', '21');
        } catch (\Throwable $e) {
            $this->getLogger(__METHOD__)->error('optionData',
                [
                    'message'        => $e->getMessage()

                ]);
        }

        return $filesService->getFtpFileNames();
    }
}
