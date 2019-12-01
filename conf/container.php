<?php
/**
 * Created by PhpStorm.
 * User: herve
 * Date: 30/11/2019
 * Time: 14:54
 */

use BulletTrain\Sample\Client\BulletTrainClient;
use BulletTrain\Sample\Engine\Templating;
use BulletTrain\Sample\Services\UserService;

return [
    Templating::class => DI\Factory(function (){

        $class = Templating::class;
        $builder = new $class();
        /** @var Templating $engine */
        $this->engine = $builder();
        return $builder();
    }),
    BulletTrainClient::class => DI\Factory(function () {
        $class = BulletTrainClient::class;
        $builder = new $class();
        /** @var BulletTrainClient $featuresFlagManager */
        return $builder();
    }),
    UserService::class => DI\Factory(function () {
        return new UserService(include dirname(__DIR__) . '/fixtures/users.php');
    }),
];
