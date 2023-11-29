<?php
require_once 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

use App\Model\TokenModel;
use GemLibrary\Helper\NoCors;
use GemFramework\Core\Bootstrap;
use GemLibrary\Helper\WebHelper;
use GemLibrary\Http\ApacheRequest;
use GemLibrary\Http\JsonResponse;


NoCors::NoCors();
$apache = new ApacheRequest();
$request = $apache->request;
$segment = explode('/',$apache->request->requestedUrl);
$controller = $segment[$_ENV['URI_CONTROLLER_SEGMENT']] ?? null;
if(!$controller || $controller == 'auth')
{
    $bootstrap = new Bootstrap($apache->request);
    die;
}
//means other route rather than index and auth controller
else
{
    $jsonResponse = new JsonResponse();
    $token = $request->authorizationHeader ?? null;
    //check it is found Authorization header
    if(!$token)
    {
       $jsonResponse->forbidden('no token found in authorization header');
       $jsonResponse->show();
       die; 
    }
    //check if Bearer Token it is settes
    $token = WebHelper::BearerTokenPurify($token);
    if(!$token)
    {
        $jsonResponse->forbidden('Bearer token is not setted');
        $jsonResponse->show();
        die;
    }
    //it means now token is setted and we can verify it
    $ins_token = new TokenModel();
    if(!$ins_token->verifyToken($token, $request->userMachine))
    {
        $jsonResponse->forbidden('token validation failed');
        $jsonResponse->show();
        die;
    }
    //now token is valid and user can run request
    $bootstrap = new Bootstrap($apache->request);
}


