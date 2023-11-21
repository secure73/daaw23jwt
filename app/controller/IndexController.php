<?php
namespace App\Controller;
use GemFramework\Core\Controller;
use GemLibrary\Http\JsonResponse;
class IndexController extends Controller
{
    public function __construct(\GemLibrary\Http\GemRequest $request)
    {
        parent::__construct($request);
    }

    public function index():JsonResponse
    {
        $this->response->success($this->request);
        return $this->response;
    }

    public function hello():JsonResponse
    {
        $this->response->success("Hello World");
        return $this->response;
    }

    public function testError():JsonResponse
    {
        $this->response->internalError("Not Found Test Error");
        return $this->response;
    }
}
