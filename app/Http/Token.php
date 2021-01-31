<?php


namespace App\Http;


use Firebase\JWT\JWT;

class Token
{
    public static function get($userId, $userName, $lifeTime = 60, $delayTime = 0)
    {
        $creationTime = time();
        $expireTime = $creationTime + $lifeTime;
        $notBeforeTime = $creationTime + $delayTime;
        $iss = 'GoodCare';

        $payload = [
            'iss' => $iss,
            'exp' => $expireTime,
            'nbf' => $notBeforeTime,
            'iat' => $creationTime,
            'data' => [
                'userId' => $userId,
                'userName' =>$userName
            ]
        ];

//        $jwtKey = base64_encode(openssl_random_pseudo_bytes(64));
        $secretKey  = env('TOKEN_KEY','secret_key');//base64_decode($jwtKey);
        return JWT::encode(
            $payload,
            $secretKey,
            'HS512'
        );
    }
}