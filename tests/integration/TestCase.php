<?php

declare(strict_types=1);

namespace Tests\integration;

use PHPUnit\Framework\TestCase as PHPUnit_TestCase;
use Slim\Psr7\Factory\StreamFactory;
use Slim\Psr7\Headers;
use Slim\Psr7\Request as SlimRequest;
use Slim\Psr7\Uri;
use Slim\Factory\AppFactory;
use DI\ContainerBuilder;
use Slim\App;
use Psr\Http\Message\ServerRequestInterface;

class TestCase extends PHPUnit_TestCase
{
    protected function getAppInstance()
    {
        require __DIR__ . '/../../vendor/autoload.php';

        $baseDir = __DIR__ . '/../../';
        $envFile = $baseDir . '.env';
        if (file_exists($envFile)) {
            $dotenv = new \Dotenv\Dotenv($baseDir);
            $dotenv->load();
        }
        
        $settings = require $baseDir . 'src/App/Settings.php';
        
        // Instancia container 
        //Container PhpDI 
        $containerBuilder = new ContainerBuilder();

        // configure PHP-DI here 
        $containerBuilder->addDefinitions(__DIR__ . '/../../src/App/Container.php');

        $container = $containerBuilder->build();
        $app = $container->get(App::class);

        $app->addRoutingMiddleware();
        $app->addBodyParsingMiddleware();
        
        $customErrorHandler = function ($request, $exception, bool $displayErrorDetails, bool $logErrors, bool $logErrorDetails) use ($app) {
            $statusCode = 500;
            if (is_int($exception->getCode()) && $exception->getCode() !== 0 && $exception->getCode() < 599) {
                $statusCode = $exception->getCode();
            }
            $className = new \ReflectionClass(get_class($exception));
            $data = [
                'message' => $exception->getMessage(),
                'class' => $className->getShortName(),
                'status' => 'error',
                'code' => $statusCode,
            ];
            $response = $app->getResponseFactory()->createResponse();
            $response->getBody()->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));

            return $response->withStatus($statusCode)->withHeader("Content-type", "application/json");
        };

        $errorMiddleware = $app->addErrorMiddleware(true, true, true);
        $errorMiddleware->setDefaultErrorHandler($customErrorHandler);
        
        require __DIR__ . '/../../src/App/Routes.php';

        
        return $app;
    }

    protected function createRequest(
        string $method,
        string $path,
        array $headers = ['HTTP_ACCEPT' => 'application/json'],
        array $cookies = [],
        array $serverParams = []
    ) {
        $uri = new Uri('', '', 80, $path);
        $handle = fopen('php://temp', 'w+');
        $stream = (new StreamFactory())->createStreamFromResource($handle);

        $h = new Headers();
        foreach ($headers as $name => $value) {
            $h->addHeader($name, $value);
        }

        return new SlimRequest($method, $uri, $h, $cookies, $serverParams, $stream);
    }
}
