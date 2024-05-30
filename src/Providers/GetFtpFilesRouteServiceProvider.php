<?php
namespace GetFtpFiles\Providers;

use Plenty\Plugin\Routing\ApiRouter;
use Plenty\Plugin\RouteServiceProvider;

/**
 * Class GetFtpFilesRouteServiceProvider
 * @package GetFtpFiles\Providers
 */
class GetFtpFilesRouteServiceProvider extends RouteServiceProvider
{
    /**
     * @param  ApiRouter  $apiRouter
     */
    public function map(ApiRouter $apiRouter)
    {
        $apiRouter->version(['v1'], ['namespace' => 'GetFtpFiles\Controllers', 'middleware' => 'oauth'],
            function ($apiRouter) {
                $apiRouter->get('GetFtpFiles/test_route/', 'TestController@testMethod');
            }
        );
    }
}
