<?php
/**
 * Created by PhpStorm.
 * User: herve
 * Date: 22/11/2019
 * Time: 00:29
 */

namespace BulletTrain\Sample\Controller;


use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class DefaultController extends BaseController
{
    public function index(RequestInterface $request, ResponseInterface $response, array $args)
    {
        $response->getBody()->write("Hello World!");
        return $response;
    }

    public function about(RequestInterface $request, ResponseInterface $response, array $args)
    {
        return $this->render($response, 'about.mustache');
    }

    public function sample(RequestInterface $request, ResponseInterface $response, array $args)
    {

        return $this->render($response, 'index.mustache', $this->featuresFlagManager->exportFlags());
    }

    public function login(RequestInterface $request, ResponseInterface $response, array $args)
    {

        return $this->render($response, 'login.mustache', $this->featuresFlagManager->exportFlags());
    }
}
