<?php

namespace GetFtpFiles\Assistants;

use GetFtpFiles\Assistants\DynamicLoaders\DynamicLoader;
use GetFtpFiles\Assistants\Handlers\SettingsHandler;
use GetFtpFiles\Assistants\DataSource\AssistantDataSource;
use GetFtpFiles\Assistants\Generators\StepGenerator;
use Plenty\Modules\Wizard\Services\WizardProvider;

class GetFtpFilesAssistant extends WizardProvider
{

    protected function structure(): array
    {
        /**
         * @var StepGenerator $stepGenerator
         */
        $stepGenerator = pluginApp(StepGenerator::class);

        return [
            "title"                  => "assistant.assistantName",
            "key"                    => "GetFtpFiles_wizard",
            "translationNamespace"   => "GetFtpFiles",
            "createOptionIdTitle"    => "assistant.createOptionIdTitle",
            "shortDescription"       => "assistant.shortDescription",
            "priority"               => 990,
            "reloadStructure"        => true,
            "deleteConfirmationText" => "assistant.deleteConfirmationText",
            "settingsHandlerClass"   => SettingsHandler::class,
            "dataSource"             => AssistantDataSource::class,
            "dependencyClass"        => DynamicLoader::class,
            "relevance"              => "essential",
            "topics"                 => ["plentymarkets"],
            "steps"                  => $stepGenerator->generate()
        ];
    }
}
