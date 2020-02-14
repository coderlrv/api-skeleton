<?php declare(strict_types=1);

namespace App\Controller\Base;

use Illuminate\Database\Capsule\Manager as DB;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Selective\Config\Configuration;
use \App\Service\UserService;


class HomeController
{
    const API_NAME = 'slim4-api-skeleton';

    const API_VERSION = '0.0.4';

    protected $container;

    public function __construct(ContainerInterface $container,UserService $userService)
    {
        $this->container = $container;
        $this->userService = $userService;
    }

    public function getHelp($request, $response)
    {
        $message = [
            'api' => self::API_NAME,
            'version' => self::API_VERSION,
            'timestamp' => time(),
        ];
        $payload = json_encode($message);
        $response->getBody()->write($payload);

        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }

    public function getStatus(Request $request, Response $response)
    {
        $this->container->get(Configuration::class);
        $status = [
            'status' => [
                'configuration' => 'OK',
            ],
            'api' => self::API_NAME,
            'version' => self::API_VERSION,
            'timestamp' => time(),
        ];
        $payload = json_encode($status);
        $response->getBody()->write($payload);

        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }

    public function getUser(Request $request, Response $response)
    {
        $status = [
            'status' => [
                'user' => $this->userService->getUser(),
            ],
            'api' => self::API_NAME,
            'version' => self::API_VERSION,
            'timestamp' => time(),
        ];
        $payload = json_encode($status);
        $response->getBody()->write($payload);

        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}
