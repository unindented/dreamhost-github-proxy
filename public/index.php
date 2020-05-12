<?php

$rootDir = dirname(__DIR__, 1);

require $rootDir . '/vendor/autoload.php';

use Dotenv\Dotenv;
use Proxy\Proxy;
use Proxy\Adapter\Guzzle\GuzzleAdapter;
use Proxy\Filter\RemoveEncodingFilter;
use Laminas\Diactoros\ServerRequestFactory;

$dotenv = Dotenv::createImmutable($rootDir);
$dotenv->load();
$dotenv->required(['URL', 'USER', 'TOKEN']);

$request = ServerRequestFactory::fromGlobals();
$guzzle = new GuzzleHttp\Client();
$proxy = new Proxy(new GuzzleAdapter($guzzle));

$response = $proxy
    ->forward($request)
    ->filter(new RemoveEncodingFilter())
    ->filter(function ($request, $response, $next) {
        $request = $request
            ->withHeader('User-Agent', $_SERVER['USER'])
            ->withHeader('Authorization', 'Bearer ' . $_SERVER['TOKEN']);
        $response = $next($request, $response);
        return $response;
    })
    ->to($_SERVER['URL']);

(new Laminas\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);

?>
