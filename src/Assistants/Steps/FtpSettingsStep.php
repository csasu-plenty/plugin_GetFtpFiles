<?php

namespace GetFtpFiles\Assistants\Steps;

use GetFtpFiles\Assistants\Interfaces\Step;

class FtpSettingsStep implements Step
{
    const IDENTIFIER = 'ftp_settings';
    /**
     *
     * @return array
     */
    public function get(): array
    {
        return [
            'title'    => 'assistant.ftpSettings',
            'sections' => $this->generateSections()
        ];
    }

    /**
     * @return array
     */
    public function generateSections(): array
    {
        return [
            $this->ftpSettingsSection()
        ];
    }

    /**
     * @return array
     */

    private function ftpSettingsSection()
    {
        return [
            'description' => 'assistant.ftpSettingsDescription',
            'form'        => [
                $this::IDENTIFIER => [
                    'type'     => 'vertical',
                    'children' => [
                        'ftp_hostname' => [
                            'type'    => 'text',
                            'options' => [
                                'name'     => 'assistant.hostname',
                                'required' => true
                            ]
                        ],
                        'ftp_username' => [
                            'type'    => 'text',
                            'options' => [
                                'name'     => 'assistant.username',
                                'required' => true
                            ]
                        ],
                        'ftp_password' => [
                            'type'    => 'text',
                            'options' => [
                                'name'       => 'assistant.password',
                                'isPassword' => true,
                                'required'   => true
                            ]
                        ]
                    ],
                ]
            ]
        ];
    }
}
