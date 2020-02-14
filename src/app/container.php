<?php

use Psr\Container\ContainerInterface;
use Selective\Config\Configuration;
use Illuminate\Database\Capsule\Manager as DB;
use Slim\App;
use Slim\Factory\AppFactory;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;

return [
    Configuration::class => function () {
        return new Configuration(require __DIR__ . '/settings.php');
    },

    App::class => function (ContainerInterface $container) {
        AppFactory::setContainer($container);
        $app = AppFactory::create();

        // Optional: Set the base path to run the app in a subdirectory.
        // $app->setBasePath('/');

        return $app;
    },

    // Database - Instancia configuranção    
    DB::class => function (ContainerInterface $container){
        $settings = $container->get(Configuration::class)->getArray('settings.db');

        $capsule = new DB;
        $capsule->addConnection($settings);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();

        return $capsule;
    },

    // The logger factory
    LoggerInterface::class => function (ContainerInterface $container) {
        $settings = $container->get(Configuration::class)->getArray('settings.logger');

        $monolog = new LoggerFactory($settings);
        $monolog->addFileHandler($settings['filename']);
        $monolog->addConsoleHandler($settings['level']);

        return $monolog->createInstance($settings['name']);
    },
];
