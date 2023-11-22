<?php

use GemLibrary\Database\PdoConnection;

class BadCode
{

    public function __construct($request)
    {
    }


    public function register(string $user_inputted_email, string $user_inputted_password):string
    {
        $find_user_result = $this->findUserByEmail($user_inputted_email);
        if ($find_user_result === null) {
            if($this->createUser($user_inputted_email,$user_inputted_password))
            {
                return json_encode('user created successfully');
            }
            else
            {
                return json_encode('please try moment later');
            }
        }
        elseif($find_user_result)
        {
            return json_encode('user already exists');
        }
        else
        {
            return json_encode('please try moment later');
        }
    }


    public function createUser(string $email, string $password): int|false
    {
        $db_connect = new PdoConnection();
        if ($db_connect->isConnected()) {
            $db_connect->query("INSERT INTO users (email , password ) values (:email , :password)");
            $db_connect->bind(':email', $email);
            $db_connect->bind(':password', password_hash($password, PASSWORD_ARGON2I));
            if ($db_connect->execute()) {
                return (int)$db_connect->lastInsertId();
            }
        }
        return false;
    }

    public function findUserByEmail(string $email): false|null|object
    {
        $db_connect = new PdoConnection();
        if ($db_connect->isConnected()) {
            $db_connect->query("SELECT * from users WHERE email = user_inputted_email");
            $db_connect->bind('user_inputted_email', $email);
            if ($db_connect->execute()) {
                $array_of_found_users = $db_connect->fetchAllObjects();
                if (count($array_of_found_users) == 1) {
                    return $array_of_found_users[0];
                } else {
                    return null;
                }
            }
        }
        return false;
    }


    public function login(string $email, string $password)
    {
    }
}
