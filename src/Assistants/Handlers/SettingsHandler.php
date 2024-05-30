<?php

namespace GetFtpFiles\Assistants\Handlers;

use Plenty\Modules\Wizard\Contracts\WizardSettingsHandler;

class SettingsHandler implements WizardSettingsHandler
{
    /**
     * @param  array  $parameters
     *
     * @return bool
     */
    public function handle(array $parameters)
    {
        return true;
    }
}
