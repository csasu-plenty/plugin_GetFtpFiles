<?php
namespace GetFtpFiles\Providers;

use ErrorException;
use Exception;
use Plenty\Modules\Cron\Services\CronContainer;
use Plenty\Modules\EventProcedures\Services\Entries\ProcedureEntry;
use Plenty\Modules\EventProcedures\Services\EventProceduresService;
use Plenty\Modules\Wizard\Contracts\WizardContainerContract;
use Plenty\Plugin\Application;
use Plenty\Plugin\ServiceProvider;
use GetFtpFiles\Assistants\GetFtpFilesAssistant;
use GetFtpFiles\Crons\TestCron;

/**
 * Class PluginServiceProvider
 * @package GetFtpFiles\Providers
 */
class PluginServiceProvider extends ServiceProvider
{
    /**
     * @param CronContainer $container
     * @param EventProceduresService $eventProceduresService
     * @param WizardContainerContract $wizardContainerContract
     * @param Application $app
     * @return void
     * @throws ErrorException
     */
    public function boot(
        CronContainer $container,
        EventProceduresService $eventProceduresService,
        WizardContainerContract $wizardContainerContract,
        Application $app
    ) {
        $container->add(CronContainer::DAILY, TestCron::class);

        $this->bootProcedures($eventProceduresService);

        $wizardContainerContract->register('GetFtpFiles_wizard', GetFtpFilesAssistant::class);
        $this->getApplication()->register(GetFtpFilesRouteServiceProvider::class);
    }

    /**
     * @param  EventProceduresService  $eventProceduresService
     */
    private function bootProcedures(EventProceduresService $eventProceduresService)
    {

        $eventProceduresService->registerProcedure(
            'GetFtpFiles',
            ProcedureEntry::EVENT_TYPE_ORDER,
            [
                'de' => ' GetFtpFiles: Return',
                'en' => ' GetFtpFiles: Return'
            ],
            '\GetFtpFiles\Procedures\TestProcedure@run'
        );

    }
}
