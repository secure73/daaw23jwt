<?php

namespace App\Model;
use GemLibrary\Helper\WebHelper;
use App\Table\UserTable;
use GemLibrary\Http\GemRequest;
use GemLibrary\Http\JsonResponse;

class UserModel extends UserTable
{

    public function __construct()
    {
        parent::__construct();
    }


    public function createUser(GemRequest $request):JsonResponse
    {
        $response = new JsonResponse();
        
        if(!WebHelper::isValidEmail($request->post['email']))
        {
           $response->badRequest('email format is not valid');
           return $response;
        }
        if(strlen($request->post['password']) < 3 )
        {
            $response->badRequest('password minimum 3 charechter');
            return $response;
        }
        $this->password = password_hash($request->post['password'], PASSWORD_ARGON2I);
        $this->email = $request->post['email'];
        if($this->insertUser())
        {
            $response->created($this->lastInsertId() , 1, 'created successfully');
            return $response;
        }
        $response->internalError($this->getError());
        return $response;
    }

} 