<?php
/**
 * Created by PhpStorm.
 * User: herve
 * Date: 24/11/2019
 * Time: 21:48
 */

namespace BulletTrain\Sample\Renderer;


use BulletTrain\Sample\Engine\Templating;
use Slim\Exception\HttpNotFoundException;
use Slim\Interfaces\ErrorRendererInterface;
use Throwable;

final class HtmlErrorRenderer implements ErrorRendererInterface
{
    /**
     * @var Templating
     */
    private $templateEngine = null;

    public function __invoke(Throwable $exception, bool $displayErrorDetails): string
    {
        $title = 'Error';
        $message = 'An error has occurred.';

        if ($exception instanceof HttpNotFoundException) {
            $title = 'Page not found';
            $message = 'This page could not be found.';
        }

        $class = Templating::class;
        $this->templateEngine = (new $class)();
        return $this->renderHtmlPage($title, $message);
    }

    public function renderHtmlPage(string $title = '', string $message = ''): string
    {
        return $this->templateEngine->render('404', ['title' => $title, 'message' => $message]);
    }
}