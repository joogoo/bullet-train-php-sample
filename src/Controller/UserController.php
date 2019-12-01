<?php
/**
 * Created by PhpStorm.
 * User: herve
 * Date: 30/11/2019
 * Time: 14:46
 */

namespace BulletTrain\Sample\Controller;


use BulletTrain\Sample\Client\BulletTrainClient;
use BulletTrain\Sample\Engine\Templating;
use BulletTrain\Sample\Exception\AccessDeniedException;
use BulletTrain\Sample\Services\UserService;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class UserController extends BaseController
{
    /**
     * @var UserService
     */
    private $service;

    /**
     * UserController constructor.
     * @param Templating $engine
     * @param BulletTrainClient $featuresFlagManager
     * @param UserService $service
     */
    public function __construct(Templating $engine, BulletTrainClient $featuresFlagManager, UserService $service)
    {
        parent::__construct($engine, $featuresFlagManager);
        $this->service = $service;
    }

    /**
     * @return UserService
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * @param UserService $service
     * @return UserController
     */
    public function setService(UserService $service)
    {
        $this->service = $service;
        return $this;
    }


    public function login(RequestInterface $request, ResponseInterface $response, array $args)
    {
        $data = $request->getParsedBody();
        try {
            $context = $this->service->signIn($data['username'], $data['password']);
        } catch (AccessDeniedException $e) {
            $context = ['login_error' => $e->getMessage()];
        }
        return $this->render($response, 'login.mustache', $context);
    }
}
