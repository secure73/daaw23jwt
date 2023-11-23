<?php
namespace App\Controller;

use App\Model\UserModel;
use GemFramework\Core\Controller;
use GemLibrary\Http\JsonResponse;

class AuthController extends Controller
{
    public function __construct(\GemLibrary\Http\GemRequest $request)
    {
        parent::__construct($request);
    }

    public function index():JsonResponse
    {
        $this->response->success(null,null, 'welcome to Auth  controller');
        return $this->response;
    }

    public function register():JsonResponse
    {
        if (!$this->request->definePostSchema(
            ['email' => 'email', 
            'password' => 'string'])) {
            $this->response->badRequest($this->request->error);
            return $this->response;
        }
        $user = new UserModel();
        return  $user->createUser($this->request);
    }
}
