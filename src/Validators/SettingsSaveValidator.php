<?php

namespace GetFtpFiles\Validators;

use Plenty\Validation\Validator;

class SettingsSaveValidator extends Validator
{
    /**
     * Will make sure that "key" is a string.
     * Will make sure that "value" is required.
     */
    protected function defineAttributes()
    {
        $this->addString('key', true);
        $this->add('value')->required();
    }
}
