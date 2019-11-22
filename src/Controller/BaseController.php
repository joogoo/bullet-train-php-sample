<?php
/**
 * Created by PhpStorm.
 * User: herve
 * Date: 22/11/2019
 * Time: 10:46
 */

namespace BulletTrain\Sample\Controller;


use BulletTrain\Sample\Engine\Templating;
use Psr\Http\Message\ResponseInterface;

class BaseController
{
    /**
     * @var Templating
     */
    protected $engine;

    public function __construct()
    {
        $class = Templating::class;
        $builder = new $class();
        /** @var Templating $engine */
        $this->engine = $builder();
    }

    /**
     * @param ResponseInterface $response
     * @param string $template
     * @param array|null $context
     * @return ResponseInterface
     */
    public function render(ResponseInterface $response, string $template, ?array $context = null): ResponseInterface
    {
        $response
            ->getBody()
                ->write(
                    $this->engine->render($template, $context)
                );
        return $response;
    }
}
