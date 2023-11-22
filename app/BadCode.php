<?php

use GemLibrary\Database\PdoConnection;

class BadCode {

    public function __construct($request)
    {
        
    }


    public function register(string $user_inputted_email, string $user_inputted_password)
    {
        $db_connect = new PdoConnection();
        if($db_connect->isConnected())
        {
            $query = "INSERT INTO users (email , password ) values (:email , :password)";
            $arrayKeyVal = [];
            $arrayKeyVal[':email'] = $user_inputted_email;
            $arrayKeyVal[':password'] = $user_inputted_password;
            

            
        }

    }


    public function login(string $email , string $password)
    {
    }

    



}