<?php
/**
 * Created by PhpStorm.
 * User: herve
 * Date: 22/11/2019
 * Time: 00:08
 */

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require '/vendor/autoload.php';

$app = AppFactory::create();

$app->get("/", function (Request $request, Response $response, array $args) {
    $response->getBody()->write("Hello World!");
    return $response;
});

$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");
    return $response;
});

$app->run();