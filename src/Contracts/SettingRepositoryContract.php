<?php

namespace GetFtpFiles\Contracts;

use Plenty\Modules\Plugin\DataBase\Contracts\Model;
use GetFtpFiles\Models\Setting;

interface SettingRepositoryContract
{
    /**
     * @param $key
     * @param $value
     *
     * @return Model
     */
    public function save($key, $value): Model;

    /**
     * @param $key
     *
     * @return string|null
     */
    public function get($key);

    /**
     * @return Setting[]
     */
    public function list();

    /**
     * @return array|mixed|string[]
     */
    public function getFtpSettings();

    /**
     * @param $prefix
     * @return array|mixed|string[]
     */
    public function getSettingsStartingWithPrefix($prefix);

}
