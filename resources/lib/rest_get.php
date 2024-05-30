<?php

require_once __DIR__ . '/ApiService.php';

$url         = SdkRestApi::getParam('url');
$accessToken = SdkRestApi::getParam('accessToken');
$params      = SdkRestApi::getParam('params');

$apiService = new ApiService();
$response     = $apiService->get($url, $accessToken, $params);

return $response;
