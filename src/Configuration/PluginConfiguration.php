<?php

namespace GetFtpFiles\Configuration;

use Exception;
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

    public function __construct(
        SettingRepository $settingRepository
    ) {
        $this->settingRepository = $settingRepository;
    }

    /**
     * @param $configKey
     *
     * @return mixed
     */
    protected function getConfigValue($configKey)
    {
        return $this->settingRepository->get($configKey);
    }

    public function getSFTPCredentials()
    {
        /** @var SettingRepository $settingsRepository */
        $settingsRepository = pluginApp(SettingRepository::class);
        return $settingsRepository->getSettingsStartingWithPrefix('ftp_');
    }
}
