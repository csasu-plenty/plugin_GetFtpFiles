<?php

require_once __DIR__ . '/OAuthService.php';

$accessTokenUrl  = SdkRestApi::getParam('accessTokenUrl');
$username        = SdkRestApi::getParam('username');
$password        = SdkRestApi::getParam('password');

$OAuthService = new OAuthService($accessTokenUrl, $username, $password);
$accessToken  = $OAuthService->getAccessToken($username, $password);

return $accessToken;
