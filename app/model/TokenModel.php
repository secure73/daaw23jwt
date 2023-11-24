<?php

namespace App\Model;
use GemLibrary\Http\GemToken;
class TokenModel
{
    public function __construct()
    {
    }


    public static function refresh(int $user_id, string $user_agent):string
    {
        return self::createToken('refresh', $user_id, $_ENV['REFRESH_TOKEN_SECOND'],[],$user_agent,null);
    }

    private static function createToken( string $type , int $user_id, int $validity ,array $payload ,string $user_agent , ?string $user_ip):string
    {
        $token = new GemToken();
       return  $token->create($type,$_ENV['TOKEN_SECRET'],$user_id,$validity,$payload,
                $_ENV['TOKEN_ISSUER'],$user_ip,$user_agent);
    }
}