<?php

namespace IziDev\Services;

use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Str;

final class Router
{
    private $prefix_api;
    private $namespace_api;
    private $routes;

    public function __construct($config)
    {
        $this->prefix_api = $config['api']['prefix'];
        $this->namespace_api = $config['api']['namespace'];
        $this->routes = $config['api']['routes'];
    }

    public function __invoke()
    {
        $this->make();
        $this->redirect();
        $this->api();
        $this->dispatch();
    }

    private function api()
    {
        collect($this->routes)
            ->map(fn($controller, $path) => [
                'path' => $this->prefix_api . '/' . $path,
                'controller' => $this->namespace_api . '\\' . $controller,
                'name' => (string)Str::of($path)->lower()->replace('/', '.'),
                'method' => $this->getMethodRoute($controller)
            ])
            ->map(fn($route) => [$route['name'], $route['method'], $route['path'], $route['controller']])
            ->each(fn($route) => $this->add($route));
    }

    private function getMethodRoute($controller)
    {
        $methods = [
            "Get",
            "Post",
            "Delete",
            "Put"
        ];

        $method = collect($methods)->filter(function ($value) use ($controller) {
            return strpos(class_basename($controller), $value) !== false;
        })->first();

        return method_exists(\Illuminate\Routing\Router::class, $method) ? strtoupper($method) : ['GET', 'HEAD', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS'];
    }

    private function add($route)
    {
        [$name, $method, $path, $controller] = $route;
        $this->router->addRoute($method, $path, $controller)->name($name);
    }

    private function make()
    {
        $container = new Container;

        $container->instance('Illuminate\Http\Request', $this->request());

        $events = new Dispatcher($container);

        $this->router = new \Illuminate\Routing\Router($events, $container);

        return $this;
    }

    private function dispatch(): void
    {
        $response = $this->router->dispatch($this->request());

        $response->send();
    }

    private function redirect(): Redirector
    {
        return new Redirector(new UrlGenerator($this->router->getRoutes(), $this->request()));
    }

    private function request(): Request
    {
        return Request::capture();
    }
}