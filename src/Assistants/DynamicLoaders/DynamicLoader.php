<?php

namespace GetFtpFiles\Assistants\DynamicLoaders;

use Plenty\Modules\Wizard\Contracts\WizardDynamicLoader;
use Plenty\Plugin\Translation\Translator;

/**
 * Class DynamicLoader
 * @package GetFtpFiles\Assistants\DynamicLoaders
 */
class DynamicLoader implements WizardDynamicLoader
{

    /**
     * @var Translator
     */
    private $translator;

    public function __construct(
    ) {
    }

}
