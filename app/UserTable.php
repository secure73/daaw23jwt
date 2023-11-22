<?php
use GemLibrary\Database\PdoConnection;
use GemLibrary\Database\PdoQuery;

class UserTable extends PdoQuery
{
    public int    $id;
    public string $email;
    protected string $password;
    public ?string $first_name;
    public ?string $last_name;


    public function __construct()
    {

    }

    public function insertUser(): int|false
    {

        //$result  = $this->insertQuery("INSERT INTO users (email , password ) values (:email , :password)" ,$array);

        if ($this->isConnected()) {
            $this->query("INSERT INTO users (email , password ) values (:email , :password)");
            $this->bind(':email', $this->email);
            $this->bind(':password', $this->password);
            if ($this->execute()) {
                return $this->lastInsertId();
            }
        }
        return false;
    }

    public function selectUserByEmail(?string $email = null):null|bool 
    {
        if($email)
        {
            $this->email = $email;
        }
        $db_connect = new PdoConnection();
        if ($db_connect->isConnected()) {
            $db_connect->query("SELECT * from users WHERE email = user_inputted_email");
            $db_connect->bind('user_inputted_email', $this->email);
            if ($db_connect->execute()) {
                $array_of_found_users = $db_connect->fetchAllObjects();
                if (count($array_of_found_users) == 1) {
                    $object = $array_of_found_users[0];
                    foreach($object as $key =>$value)
                    {
                        $this->$key = $value;
                    }
                } else {
                    return null;
                }
            }
        }
        $this->error = $db_connect->getError();
        return false;
    }
}