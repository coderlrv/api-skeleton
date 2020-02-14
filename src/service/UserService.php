<?php declare(strict_types=1);

namespace App\Service;

use Selective\Config\Configuration;

class UserService
{
    protected $config;

    public function __construct(Configuration $config){
        $this->config = $config;
    }

    public function getUser(){

        return [
            'id'  => '1',
            'name'=>'teste'
        ];
    }
}
