<?php

namespace GetFtpFiles\Services;

use GetFtpFiles\Clients\SFTPClient;
use GetFtpFiles\Helpers\VariationHelper;
use Plenty\Modules\Item\Variation\Models\Variation;
use Plenty\Plugin\Log\Loggable;
use Plenty\Plugin\Translation\Translator;

class ReadFilesService
{
    use Loggable;

    /**
     * @var Translator
     */
    private $translator;

    /**
     * @var SFTPClient
     */
    private $sftpClient;

    /** @var VariationHelper */
    private $variationHelper;

    public function __construct(
        Translator                  $translator,
        SFTPClient                  $sftpClient,
        VariationHelper             $variationHelper
    ) {
        $this->translator       = $translator;
        $this->sftpClient       = $sftpClient;
        $this->variationHelper  = $variationHelper;
    }

    private function getFtpFileNames()
    {
        try {
            $files = $this->sftpClient->readFiles('');
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

        return $files;
    }

    private function getDataFromFileName($fileName)
    {
        $fileData = [];

        $dataParts = explode('_', $fileName);

        $fileData['fileName'] = $fileName;
        if (count($dataParts) != 2){
            $fileData['error'] = 'File structure corrupt!';
        } else {
            $fileData['variationNumber'] = $dataParts[0];
            $dataParts = explode('.', $dataParts[1]);
            if (count($dataParts) != 2){
                $fileData['error'] = 'Image position and file extension can not be separated!';
            } else {
                $fileData['imagePosition'] = $dataParts[0];
                $fileData['fileExtension'] = $dataParts[1];
            }
        }
        return $fileData;
    }

    private function deleteFileFromFtp($fileName)
    {
        try {
            $files = $this->sftpClient->deleteFile($fileName);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

        return $files;
    }

    public function processFtpFiles()
    {
        $response = [];

        //get files from FTP
        $files = $this->getFtpFileNames();

        //process files from FTP
        foreach ($files as $file){
            $fileData = $this->getDataFromFileName($file['fileName']);
            if (isset($fileData['error'])){
                //log error
            } else {
                $variation = $this->variationHelper->getVariationByNumber($fileData['variationNumber']);
                if (is_null($variation)){
                    //log error
                    $fileData['error'] = 'There is no variation with this variation number!';
                } else{
                    $fileData['itemId'] = $variation['itemId'];
                    $fileData['variationId'] = $variation['variationId'];
                    $fileData['imageData'] = $file['contents'];

                    if ($this->variationHelper->addImageToVariation(
                        [
                            'fileType'          => $fileData['fileExtension'],
                            'uploadFileName'    => $fileData['fileName'],
                            'uploadImageData'   => $fileData['imageData'],
                            'itemId'            => $fileData['itemId'],
                            'variationId'       => $fileData['variationId'],
                        ],
                        (int)$fileData['variationId'],
                        (int)$fileData['imagePosition'])
                    ){
                        $fileData['deleted'] = $this->deleteFileFromFtp($file['fileName']);
                    } else {
                        //log error
                    }
                }

            }
            $response[] = $fileData;
        }

        return $response;
    }
}
