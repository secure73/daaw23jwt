<?php
require_once 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

use GemLibrary\Helper\NoCors;
use GemFramework\Core\Bootstrap;
use GemLibrary\Http\ApacheRequest;

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
    //check for token
    //if token valid 
    //run app
    //$bootstrap = new Bootstrap($serverRequest->request);

    echo "try to visit protectd Route";
}


