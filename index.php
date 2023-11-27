<?php
require_once 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

use GemLibrary\Helper\NoCors;
use GemFramework\Core\Bootstrap;
use GemLibrary\Http\ApacheRequest;
use GemLibrary\Http\JsonResponse;


NoCors::NoCors();
$serverRequest = new ApacheRequest();

$request = $serverRequest->request;
$split = explode('/', $request->get['url']);
$controller = $split[0];

if($controller == 'auth')
{
    $bootstrap = new Bootstrap($serverRequest->request);
    return;
}
else
{
    $jsonResponse = new JsonResponse();
    //check it is found Authorization header
    if(!isset($serverRequest->request->authorizationHeader))
    {
       $jsonResponse->forbidden('no token found in authorization header');
       $jsonResponse->show();
       die; 
    }

    $jsonResponse->success($serverRequest->request->authorizationHeader);
    $jsonResponse->show();
}


