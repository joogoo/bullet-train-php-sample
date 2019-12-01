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

    public function __construct(Templating $engine, BulletTrainClient $featuresFlagManager)
    {
        $this->engine = $engine;
        $this->featuresFlagManager = $featuresFlagManager;
    }

    /**
     * @param ResponseInterface $response
     * @param string $template
     * @param array|null $context
     * @return ResponseInterface
     */
    public function render(ResponseInterface $response, string $template, ?array $context = []): ResponseInterface
    {
        $features = $this->featuresFlagManager->export();
        $data = array_merge($features, $context);
        $response
            ->getBody()
                ->write(
                    $this->engine->render($template, $data)
                );
        return $response;
    }
}
