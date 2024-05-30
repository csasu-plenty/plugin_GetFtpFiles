<?php

namespace GetFtpFiles\Assistants\Generators;

use GetFtpFiles\Assistants\Steps\FtpSettingsStep;

/**
 * Class StepGenerator
 * @package GetFtpFiles\Assistants\Generators
 */
class StepGenerator
{
    /**
     * @var FtpSettingsStep
     */
    private $ftpSettingsStep;

    public function __construct(
        FtpSettingsStep               $ftpSettingsStep
    ) {
        $this->ftpSettingsStep       = $ftpSettingsStep;
    }

    /**
     * Generate wizards steps
     *
     * @return array
     */
    public function generate()
    {
        return [
            FtpSettingsStep::IDENTIFIER               => $this->ftpSettingsStep->get(),
        ];
    }
}
