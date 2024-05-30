<?php

namespace GetFtpFiles\Assistants\DataSource;

use Plenty\Modules\Wizard\Services\DataSources\BaseWizardDataSource;
use Plenty\Plugin\Log\Loggable;
use GetFtpFiles\Assistants\Steps\FtpSettingsStep;
use GetFtpFiles\Repositories\SettingRepository;

class AssistantDataSource extends BaseWizardDataSource
{

    use Loggable;

    public function __construct(
    ) {
    }

    /**
     * @return array
     */
    public function getIdentifiers(): array
    {
        return array_keys($this->getAllEntities());
    }

    /**
     * @return array
     */
    public function get(): array
    {
        $dataStructure         = $this->dataStructure;
        $dataStructure['data'] = (object)$this->getAllEntities();

        return $dataStructure;
    }

    /**
     * @param  string  $optionId
     * @return array
     */
    public function getByOptionId(string $optionId = 'default'): array
    {
        $dataStructure         = $this->dataStructure;
        $entities              = $this->getAllEntities();
        $dataStructure['data'] = (object)$entities;

        return $dataStructure;
    }

    /**
     * @return array|mixed
     */
    private function getBasicSettings($prefixName)
    {
        // @var SettingRepository $settingsRepository
        $settingsRepository = pluginApp(SettingRepository::class);
        return $settingsRepository->getSettingsStartingWithPrefix($prefixName);
    }

    /**
     *  [
     *      'formKey' => 'value',
     *      'formKey2' => 'value'
     *  ]
     * @return array
     */
    private function getAllEntities(): array

    {
        $entities                                               = [];
        $entities[FtpSettingsStep::IDENTIFIER]                = $this->getBasicSettings('email_');

        return $entities;
    }

    /**
     * @param  string  $optionId
     * @param  array   $data
     * @param  string  $stepKey
     * @return array
     * @throws \Throwable
     */
    public function updateDataOption(string $optionId = 'default', array $data = [], string $stepKey = ''): array
    {
        switch ($stepKey) {
            case FtpSettingsStep::IDENTIFIER:
                $this->updateConnectionDataOption($data, $stepKey);
                break;
        }

        return parent::updateDataOption($optionId, $data, $stepKey);
    }

    /**
     * @param $data
     * @param $stepKey
     * @return void
     */
    private function updateConnectionDataOption($data, $stepKey): void
    {
        /** @var SettingRepository $settingsRepository */
        $settingsRepository = pluginApp(SettingRepository::class);
        foreach ($data[$stepKey] as $key => $value) {
            try {
                $settingsRepository->save((string)$key, (string)$value);
            } catch (\Throwable $e) {
                $this->getLogger(__METHOD__)->error('optionData',
                    [
                        'message'        => $e->getMessage(),
                        'connectionData' => $data[$stepKey]
                    ]);
                continue;
            }
        }
    }
}
