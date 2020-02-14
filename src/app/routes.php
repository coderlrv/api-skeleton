<?php declare(strict_types=1);
use Slim\Routing\RouteCollectorProxy;

$app->get('/', 'App\Controller\Base\HomeController:getHelp');

// Login Route
$app->post('/login','App\Controller\Base\AuthController:login');

// Area restrita
$app->group('/api',function(RouteCollectorProxy $group) {
    $group->get('/status','App\Controller\Base\HomeController:getStatus');
    $group->get('/user','App\Controller\Base\HomeController:getUser');
})->add('App\Middleware\JwtAuth');