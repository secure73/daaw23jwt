<?php

use GemLibrary\Helper\StringHelper;
use GemLibrary\Helper\TypeHelper;
use GemLibrary\Helper\WebHelper;

class UserModel extends UserTable
{

    public function __construct()
    {
        parent::__construct();
    }


    public function createUser(string $email):int|false
    {
        if(!WebHelper::isValidEmail($email))
        {
           $this->error = 'unvalid email format';
           return false;
        }
        if($this->selectUserByEmail($email))
        {
            $this->error = 'already exists';
            return false;
        }
        $this->password = password_hash(StringHelper::randomString(5), PASSWORD_ARGON2I);
        $this->email = $email;
        return $this->insertUser();
    }

} 