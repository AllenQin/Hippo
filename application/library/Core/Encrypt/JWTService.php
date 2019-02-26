<?php
namespace App\Library\Core\Encrypt;

use Firebase\JWT\JWT;

class JWTService
{
    private $key;
    private $iss;
    private $aud;

    public function __construct($container)
    {
        $this->key = $container['config']['auth']['key'];
        $this->iss = $this->aud = $container['config']['cookie']['domain'];
    }

    public function encryptEncode($value)
    {
        $timeStamp = time();
        $token = [
            'iss' => $this->iss,
            'aud' => $this->aud,
            'iat' => $timeStamp,
            'nbf' => $timeStamp,
            'val' => $value,
        ];

        return JWT::encode($token, $this->key);
    }

    public function encryptDecode($token)
    {
        return JWT::decode($token, $this->key, ['HS256']);
    }
}
