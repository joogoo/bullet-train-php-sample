<?php
/**
 * Created by PhpStorm.
 * User: herve
 * Date: 22/11/2019
 * Time: 10:46
 */

namespace BulletTrain\Sample\Controller;


use BulletTrain\Sample\Client\BulletTrainClient;
use BulletTrain\Sample\Engine\Templating;
use Psr\Http\Message\ResponseInterface;

class BaseController
{
    /**
     * @var Templating
     */
    protected $engine;

    /**
     * @var array
     */
    protected $features;

    /**
     * @var BulletTrainClient
     */
    protected $featuresFlagManager;

    public function __construct()
    {
        $class = Templating::class;
        $builder = new $class();
        /** @var Templating $engine */
        $this->engine = $builder();

        $class = BulletTrainClient::class;
        $builder = new $class();
        /** @var BulletTrainClient $featuresFlagManager */
        $this->featuresFlagManager = $builder();
    }

    /**
     * @param ResponseInterface $response
     * @param string $template
     * @param array|null $context
     * @return ResponseInterface
     */
    public function render(ResponseInterface $response, string $template, ?array $context = null): ResponseInterface
    {
        $context = $context ?? $this->featuresFlagManager->exportFlags();
        $response
            ->getBody()
                ->write(
                    $this->engine->render($template, $context)
                );
        return $response;
    }
}
