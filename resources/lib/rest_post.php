<?php

require_once __DIR__ . '/ApiService.php';

$url         = SdkRestApi::getParam('url');
$accessToken = SdkRestApi::getParam('accessToken');
$data        = SdkRestApi::getParam('data');

try {
    $apiService = new ApiService();
    $response = $apiService->post($url, $accessToken, $data);
} catch (Throwable $ex) {
    return [
        'error_msg' => $ex->getMessage()
    ];
}

return $response;
