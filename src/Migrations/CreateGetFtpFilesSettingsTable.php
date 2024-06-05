<?php

namespace GetFtpFiles\Migrations;

use Plenty\Modules\Plugin\DataBase\Contracts\Migrate;
use Plenty\Modules\Plugin\Exceptions\MySQLMigrateException;
use GetFtpFiles\Models\Setting;

class CreateGetFtpFilesSettingsTable
{
    /**
     * @param  Migrate  $migrate
     * @throws MySQLMigrateException
     */
    public function run(Migrate $migrate)
    {
        $migrate->createTable(Setting::class);
    }

    /**
     * @param Migrate $migrate
     * @return void
     */
    protected function rollback(Migrate $migrate)
    {
        $migrate->deleteTable(Setting::class);
    }
}
