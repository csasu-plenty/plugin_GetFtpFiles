<?php

require_once __DIR__ . '/FtpClient.php';

$protocol   = SdkRestApi::getParam('transferProtocol');
$host       = SdkRestApi::getParam('host');
$user       = SdkRestApi::getParam('user');
$password   = SdkRestApi::getParam('password');
$port       = SdkRestApi::getParam('port');
$path       = SdkRestApi::getParam('folderPath');
return [$protocol, $host, $user, $password, $port, $path];
$ftp = new FtpClient($protocol, $host, $user, $password, $port);

$allEntries = $ftp->getFileNames($path);

$files = [];

foreach ($allEntries as $entry) {

    if(empty($entry) || is_dir($entry)){
        continue;
    }
    $fileContents = $ftp->downloadFile($path . '/' . $entry);
    $files[] = [
        'fileName'  => $entry,
        'contents'  => $fileContents
    ];
}

return $files;
