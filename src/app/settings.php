<?php declare(strict_types=1);

return [
    'settings' => [
        'phinx'=>[
            'paths' => [
                'migrations' => __DIR__.'/../../database/migrations',
                'seeds' => __DIR__.'/../../database/seeds',
            ],
            'migration_base_class' => '\Database\Migration',
        ],
        'db' => [
            'driver'    => 'mysql',
            'host'      => getenv('DB_HOST'),
            'database'  => getenv('DB_NAME'),
            'username'  => getenv('DB_USER'),
            'password'  => getenv('DB_PASS'),
            'port'      => getenv('DB_PORT'),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => ''    
        ],
        'jwt' => [
            'secret' => 'teste'
        ],
        'logger'=>[
            'name' => 'app',
            'path' => __DIR__.'/../../tmp/logs',
            'filename' => 'app.log',
            'level' => \Monolog\Logger::ERROR,
            'file_permission' => 0775,
        ]
    ],
];
