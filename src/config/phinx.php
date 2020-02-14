<?php

$settings = (require __DIR__.'/../App/Settings.php')['settings'];

// Configuracao banco sempre pega oque tiver configurado no .env


use Selective\Config\Configuration;
use Illuminate\Database\Capsule\Manager as DB;
use Slim\App;

/** @var App $app */
$app = require __DIR__ . '/../app/App.php';

$container = $app->getContainer();
$db = $container->get(DB::class);

//Recupera PDO aloquent passa pro phinx.
$pdo = $db->connection()->getPdo();

// Busca configuracao 
$settings = $container->get(Configuration::class)->getArray('settings');

$database = $settings['db']['database'];

$phinx = $settings['phinx'];
$phinx['environments']['local'] = [
    // Set database name
    'name'       => $database,
    'connection' => $pdo,
];

return $phinx;