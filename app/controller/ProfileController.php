<?php
namespace app\controller;

use GemFramework\Core\Controller;

class ProfileController extends Controller
{
    public function index()
    {
        $this->response->success('wilkommen bei Profile Controller');
        return $this->response;
    }
}