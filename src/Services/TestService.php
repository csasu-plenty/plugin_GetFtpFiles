<?php

namespace GetFtpFiles\Services;

use Plenty\Modules\Order\Contracts\OrderRepositoryContract;
use Plenty\Modules\Order\Models\Order;
use Plenty\Plugin\Log\Loggable;
use Plenty\Plugin\Mail\Services\MailerService;
use Plenty\Plugin\Translation\Translator;
use Plenty\Plugin\Mail\Contracts\MailerContract;
use GetFtpFiles\Configuration\PluginConfiguration;
use GetFtpFiles\Repositories\SettingRepository;

class TestService
{
    use Loggable;

    /**
     * @var Translator
     */
    private $translator;

    /**
     * @var MailerService
     */
    private $mailerService;

    public function __construct(
        Translator                  $translator,
        MailerContract              $mailerService
    ) {
        $this->translator           = $translator;
        $this->mailerService        = $mailerService;

    }

}
