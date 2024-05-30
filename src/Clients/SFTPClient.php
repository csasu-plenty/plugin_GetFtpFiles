<?php

namespace GetFtpFiles\Clients;

use Exception;
use GetFtpFiles\Configuration\PluginConfiguration;
use Plenty\Modules\Plugin\Libs\Contracts\LibraryCallContract;
use Plenty\Plugin\Log\Loggable;

class SFTPClient
{
    use Loggable;

    const TRANSFER_PROTOCOL = 'SFTP';

    /** @var LibraryCallContract */
    private $library;

    /** @var array */
    private $credentials;

    /**
     * SFTPClient constructor.
     *
     * @param  LibraryCallContract  $library
     * @param  PluginConfiguration  $pluginConfig
     *
     * @throws \Exception
     */
    public function __construct(LibraryCallContract $library, PluginConfiguration $pluginConfig)
    {
        $this->library = $library;

        try {
            $this->credentials = $pluginConfig->getSFTPCredentials();
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }

    /**
     * @param  string  $folderPath
     * @return array
     * @throws \Exception
     */
    public function downloadFiles(string $folderPath)
    {
        $result = $this->library->call(PluginConfiguration::PLUGIN_NAME . '::ftp_downloadFiles', [
            'transferProtocol' => self::TRANSFER_PROTOCOL,
            'host'             => $this->credentials['host'],
            'user'             => $this->credentials['user'],
            'password'         => $this->credentials['password'],
            'port'             => $this->credentials['port'],
            'folderPath'       => $folderPath
        ]);

        if (is_array($result) && array_key_exists('error', $result) && $result['error'] === true) {
            $this->getLogger(__METHOD__)
                ->error(PluginConfiguration::PLUGIN_NAME . '::error.downloadFilesError',
                    [
                        'errorMsg'   => $result['error_msg'],
                        'errorFile'  => $result['error_file'],
                        'errorLine'  => $result['error_line'],
                        'host'       => $this->credentials['host'],
                        'user'       => $this->credentials['user'],
                        'port'       => $this->credentials['port'],
                        'folderPath' => $folderPath
                    ]
                );

            throw new \Exception($result['error_msg']);
        }

        return $result;
    }
}
