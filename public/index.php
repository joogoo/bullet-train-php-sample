<?php
/**
 * Created by PhpStorm.
 * User: herve
 * Date: 22/11/2019
 * Time: 00:08
 */

use BulletTrain\Sample\Client\BulletTrainClient;
use BulletTrain\Sample\Renderer\HtmlErrorRenderer;

use DI\ContainerBuilder;
use Slim\Factory\AppFactory;

require '../vendor/autoload.php';

$class = BulletTrainClient::class;
$builder = new $class();
/** @var BulletTrainClient $featuresFlagManager */
$featuresFlagManager = $builder();

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions('../conf/container.php');


AppFactory::setContainer($containerBuilder->build());
$app = AppFactory::create();

$errorMiddleware = $app->addErrorMiddleware(true, true, true);
$errorHandler = $errorMiddleware->getDefaultErrorHandler();
$errorHandler->registerErrorRenderer('text/html', HtmlErrorRenderer::class);

$app->get("/", \BulletTrain\Sample\Controller\DefaultController::class . ":index");
$app->get('/about', \BulletTrain\Sample\Controller\DefaultController::class . ":about");
if ($featuresFlagManager->isFlagEnabled('login')) {
    $app->get('/login', \BulletTrain\Sample\Controller\DefaultController::class . ":login");
    $app->post('/login', \BulletTrain\Sample\Controller\UserController::class . ":login");
}

$app->run();