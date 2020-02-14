<?php declare(strict_types=1);

use DI\ContainerBuilder;
use Slim\Factory\AppFactory;
use Slim\App;

require __DIR__ . '/../../vendor/autoload.php';

$baseDir = __DIR__ . '/../../';

// Carrega dados do arquivo .env
$dotenv = new Dotenv\Dotenv($baseDir);
if (file_exists($baseDir . '.env')) {
    $dotenv->load();
}
$dotenv->required(['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASS','DB_PORT']);

$settings = require __DIR__ . '/settings.php';

// Instancia container 
//Container PhpDI 
$containerBuilder = new ContainerBuilder();

// configure PHP-DI here
$containerBuilder->addDefinitions(__DIR__ . '/container.php');

$container = $containerBuilder->build();
$app = $container->get(App::class);

// 
require __DIR__ . '/middleware.php';
require __DIR__ . '/routes.php';

// Retorna exception caso nao existe a rota.
$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function ($request, $response) {
    throw new Slim\Exception\HttpNotFoundException($request);
});


return $app;