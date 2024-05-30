<?php

require_once __DIR__ . '/FtpClient.php';

$protocol = SdkRestApi::getParam('transferProtocol');
$host = SdkRestApi::getParam('host');
$user = SdkRestApi::getParam('user');
$password = SdkRestApi::getParam('password');
$port = SdkRestApi::getParam('port');
$path = SdkRestApi::getParam('folderPath');

$ftp = new FtpClient($protocol, $host, $user, $password, $port);

$files = $ftp->getFileNames($path);

return $files;
