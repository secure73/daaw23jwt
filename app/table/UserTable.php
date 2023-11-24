<?php
namespace App\Table;
use GemLibrary\Database\PdoQuery;

class UserTable extends PdoQuery
{
    public int        $id;
    public string     $email;
    protected string  $password;
    public ?string    $first_name;
    public ?string    $last_name;


    public function __construct()
    {
        parent::__construct();
    }

    public function insertUser(): int|false
    {

        return $this->insertQuery("INSERT INTO users (email , password ) values (:email , :password)",
         [':email' => $this->email, ':password' => $this->password]);
    }

    /**
     * @param string|null $email
     * @return object|false
     */
    public function selectUserByEmail(string $email): object|false
    {
        $result = $this->selectQueryObjets("SELECT * FROM users WHERE email = :email", [':email' => $email]);
        if($result && count($result) ==1)
        {
            return $result[0];
        }
        return false;
    }
}
