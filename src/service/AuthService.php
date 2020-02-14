<?php declare(strict_types=1);

namespace App\Service;

use Selective\Config\Configuration;
use Firebase\JWT\JWT;

class AuthService
{
    protected $config;

    public function __construct(Configuration $config){
        $this->config = $config;
    }

    public function makeToken($data){
        $secret = $this->config->getString('settings.jwt.secret');
        
        $payload = array(
            "iss" => "http://example.org",
            "aud" => "http://example.com",
            "iat" => 1356999524,
            "nbf" => 1357000000,
            "data"=> $data
        );

        return JWT::encode( $payload, $secret,'HS512');
    }
}
