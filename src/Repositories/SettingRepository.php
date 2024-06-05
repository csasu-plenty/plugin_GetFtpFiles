<?php

namespace GetFtpFiles\Repositories;

use GetFtpFiles\Contracts\SettingRepositoryContract;
use GetFtpFiles\Models\Setting;
use GetFtpFiles\Validators\SettingsSaveValidator;
use Plenty\Plugin\ConfigRepository;
use Plenty\Exceptions\ValidationException;
use Plenty\Modules\Plugin\DataBase\Contracts\DataBase;
use Plenty\Modules\Plugin\DataBase\Contracts\Model;

class SettingRepository implements SettingRepositoryContract
{
    /**
     * @var DataBase
     */
    private $database;

    /**
     * @var ConfigRepository
     */
    private $configRepository;

    /**
     * SettingsRepository constructor.
     *
     * @param  DataBase  $database
     */
    public function __construct(ConfigRepository $configRepository, DataBase $database)
    {
        $this->configRepository = $configRepository;
        $this->database = $database;
    }

    /**
     * @param $key
     * @param $value
     * @return Model
     * @throws ValidationException
     */
    public function save($key, $value): Model
    {
        SettingsSaveValidator::validateOrFail([
            'key'   => $key,
            'value' => $value
        ]);

        $settings        = pluginApp(Setting::class);
        $settings->key   = (string)$key;
        $settings->value = (string)$value;

        return $this->database->save($settings);
    }

    /**
     * @return array|mixed|string[]
     */
    public function getFtpSettings(){
        return $this->getSettingsStartingWithPrefix('ftp_');
    }

    /**
     * @param $prefix
     * @return array|mixed|string[]
     */
    public function getSettingsStartingWithPrefix($prefix){
        $basicData = [];
        $settings = $this->list();
        foreach ($settings as $setting) {
            if ( substr($setting->key, 0, strlen($prefix)) != $prefix){
                continue;
            }
            /** @var Setting $setting */
            $basicData += $setting->jsonSerialize();
        }
        return $basicData;
    }

    /**
     * @param $key
     * @return mixed|string|null
     */
    public function get($key)
    {
        /*
        $settings = $this->database->query(Setting::class)
            ->where('key', '=', $key)
            ->get();

        return is_array($settings) ? $settings[0]->value : null;
        */
        $this->configRepository->get(self::PLUGIN_NAME . '.' . $key);
    }

    /**
     * @return Setting[]
     */
    public function list()
    {
        return $this->database->query(Setting::class)->get();
    }
}
