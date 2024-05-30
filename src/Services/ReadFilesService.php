<?php

namespace GetFtpFiles\Services;

use GetFtpFiles\Clients\SFTPClient;
use Plenty\Plugin\Log\Loggable;
use Plenty\Plugin\Translation\Translator;

class ReadFilesService
{
    use Loggable;

    /**
     * @var Translator
     */
    private $translator;

    /**
     * @var SFTPClient
     */
    private $sftpClient;

    public function __construct(
        Translator                  $translator,
        SFTPClient                  $sftpClient
    ) {
        $this->translator        = $translator;
        $this->sftpClient        = $sftpClient;
    }

    public function getFtpFileNames()
    {
        try {
            $files = $this->sftpClient->readFiles('');
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

        return $files;
    }
}
