<?php

namespace GetFtpFiles\Configuration;

use Exception;
use Plenty\Plugin\ConfigRepository;
use Plenty\Plugin\Log\Loggable;
use GetFtpFiles\Repositories\SettingRepository;

class PluginConfiguration
{
    use Loggable;

    const PLUGIN_NAME            = "GetFtpFiles";

    /**
     * @var SettingRepository
     */
    private $settingRepository;

    /**
     * @var ConfigRepository
     */
    private $configRepository;

    public function __construct(
        ConfigRepository $configRepository,
        SettingRepository $settingRepository
    ) {
        $this->configRepository  = $configRepository;
        $this->settingRepository = $settingRepository;
    }

    /**
     * @param $configKey
     *
     * @return mixed
     */
    protected function getConfigValue($configKey)
    {
        //return $this->settingRepository->get($configKey);
        return $this->configRepository->get(self::PLUGIN_NAME . '.' . $configKey);
    }

    /**
     * @return array|mixed|string[]
     */
    public function getSFTPCredentials()
    {
        $ftpHost = $this->getConfigValue('host');
        $ftpUser = $this->getConfigValue('username');
        $ftpPassword = $this->getConfigValue('password');
        $ftpPort = $this->getConfigValue('port');
        $ftpFolder = $this->getConfigValue('folderPath');

        if ($ftpHost === null || $ftpUser === null || $ftpPassword === null || $ftpPort === null || $ftpFolder === null) {
            $this->getLogger(__METHOD__)->error(self::PLUGIN_NAME . '::error.mandatoryCredentialsAreNotSet',
                [
                    'ftp_hostname'     => $ftpHost,
                    'ftp_username'     => $ftpUser,
                    'ftp_password'     => $ftpPassword,
                    'ftp_port'         => $ftpPort,
                    'ftpFolder'        => $ftpFolder,
                ]);

            return [
                'error' => true
            ];
        }

        return [
            'ftp_hostname'     => $ftpHost,
            'ftp_username'     => $ftpUser,
            'ftp_password'     => $ftpPassword,
            'ftp_port'         => $ftpPort,
            'folder'           => $ftpFolder,
        ];
    }
}
