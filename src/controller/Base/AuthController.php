<?php declare(strict_types=1);

namespace App\Controller\Base;

use Slim\App;
use Illuminate\Database\Capsule\Manager as DB;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Selective\Config\Configuration;
use \App\Service\UserService;
use \App\Service\AuthService;
use Firebase\JWT\JWT;

class AuthController extends BaseController
{
    public function __construct(App $app, UserService $userService,AuthService $authService)
    {
        parent::__construct($app);

        $this->userService = $userService;
        $this->authService = $authService;
    }

    public function login($request, $response)
    {
        $user = $this->userService->getUser();

        return $this->withJson($response,$this->authService->makeToken($user));
    }
}
