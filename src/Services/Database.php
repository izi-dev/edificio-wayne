<?php

namespace IziDev\Services;

use Illuminate\Database\Capsule\Manager as Capsule;

class Database
{
    private $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function __invoke()
    {
        $config = $this->config;
        $capsule = new Capsule;

        $capsule->addConnection([
            'driver' => $config['DB_CONNECTION'],
            'host' => $config['DB_HOST'],
            'database' => $config['DB_DATABASE'],
            'username' => $config['DB_USERNAME'],
            'password' => $config['DB_PASSWORD'] ?: "",
            'port' => $config['DB_PORT'],
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ]);

        $capsule->setAsGlobal();

        $capsule->bootEloquent();
    }
}