<?php
/**
 * Created by PhpStorm.
 * User: herve
 * Date: 22/11/2019
 * Time: 00:08
 */

use BulletTrain\Sample\Client\BulletTrainClient;
use BulletTrain\Sample\Renderer\HtmlErrorRenderer;
use Slim\Factory\AppFactory;

require '../vendor/autoload.php';

$class = BulletTrainClient::class;
$builder = new $class();
/** @var BulletTrainClient $featuresFlagManager */
$featuresFlagManager = $builder();

$app = AppFactory::create();

$errorMiddleware = $app->addErrorMiddleware(false, false, false);
$errorHandler = $errorMiddleware->getDefaultErrorHandler();
$errorHandler->registerErrorRenderer('text/html', HtmlErrorRenderer::class);

$app->get("/", \BulletTrain\Sample\Controller\DefaultController::class . ":index");
$app->get('/about', \BulletTrain\Sample\Controller\DefaultController::class . ":about");
if ($featuresFlagManager->isFlagEnabled('login')) {
    $app->get('/login', \BulletTrain\Sample\Controller\DefaultController::class . ":login");
}

$app->run();