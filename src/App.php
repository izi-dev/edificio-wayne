<?php

namespace IziDev;

use IziDev\Services\Database;
use IziDev\Services\Router;

final class App
{
    public function run()
    {
        $this->database();
        $this->migrate();
        $this->seeds();
        $this->routes();
    }

    private function routes()
    {
        $config = include __DIR__ . '/Config/route.php';
        $route = new Router($config);
        $route->__invoke();
    }

    private function database()
    {
        $config = include __DIR__ . '/Config/database.php';
        $db = new Database($config);
        $db->__invoke();
    }

    private function migrate()
    {
        $classes = include __DIR__ . "/Database/Migrations/Migrate.php";

        foreach ($classes as $class) {
            call_user_func_array([$class, "execute"], []);
        }
    }

    private function seeds()
    {
        $classes = include __DIR__ . "/Database/Seeds/Seed.php";

        foreach ($classes as $class) {
            call_user_func_array([$class, "execute"], []);
        }
    }
}