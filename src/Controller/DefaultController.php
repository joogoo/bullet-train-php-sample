<?php
/**
 * Created by PhpStorm.
 * User: herve
 * Date: 22/11/2019
 * Time: 00:29
 */

namespace BulletTrain\Sample\Controller;


use BulletTrain\Sample\Engine\Templating;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class DefaultController
{
    public function index(RequestInterface $request, ResponseInterface $response, array $args)
    {
        $response->getBody()->write("Hello World!");
        return $response;
    }

    public function hello(RequestInterface $request, ResponseInterface $response, array $args)
    {
        $name = $args['name'];
        $response->getBody()->write("Hello, $name");
        return $response;
    }

    public function sample(RequestInterface $request, ResponseInterface $response, array $args)
    {
        $class = Templating::class;
        $builder = new $class();
        /** @var Templating $engine */
        $engine = $builder();

        $response->getBody()->write($engine->render('index.mustache'));
        return $response;
    }
}
