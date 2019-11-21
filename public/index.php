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
use Slim\Factory\ServerRequestCreatorFactory;


require '/vendor/autoload.php';


//AppFactory::setSlimHttpDecoratorsAutomaticDetection(false);
//ServerRequestCreatorFactory::setSlimHttpDecoratorsAutomaticDetection(false);

$app = AppFactory::create();

//$app->addErrorMiddleware(true, true, true);

$app->get("/", \BulletTrain\Sample\Controller\DefaultController::class . ":index");

$app->get('/hello/{name}', \BulletTrain\Sample\Controller\DefaultController::class . ":hello");

$app->run();