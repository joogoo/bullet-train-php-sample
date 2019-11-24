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
    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     */
    public function index(RequestInterface $request, ResponseInterface $response, array $args)
    {
        $data = $this->featuresFlagManager->exportFlags();
        return $this->render($response, 'index.mustache', array_merge($data, ['debug' => $data]));
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     */
    public function about(RequestInterface $request, ResponseInterface $response, array $args)
    {
        return $this->render($response, 'about.mustache');
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     */
    public function login(RequestInterface $request, ResponseInterface $response, array $args)
    {
        return $this->render($response, 'login.mustache', $this->featuresFlagManager->exportFlags());
    }
}
