<?php

namespace App\Model;
use GemLibrary\Http\GemToken;
class TokenModel extends GemToken
{
    public function __construct()
    {
        parent::__construct($_ENV['TOKEN_SECRET'], $_ENV['TOKEN_ISSUER']);
    }

    public function createToken(int $user_id, string $user_agent):string
    {
        return $this->create('refresh', $user_id, $_ENV['REFRESH_TOKEN_SECOND'],[],null,$user_agent);
    }

    public function verifyToken(string $token, string $user_agent):bool
    {
        return $this->validate($token,null,$user_agent);
    }
}