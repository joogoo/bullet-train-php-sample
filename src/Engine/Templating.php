<?php
/**
 * Created by PhpStorm.
 * User: herve
 * Date: 22/11/2019
 * Time: 08:00
 */

namespace BulletTrain\Sample\Engine;


use Mustache_Loader_FilesystemLoader;

class Templating
{

    /**
     * @var string
     */
    private $templateDir = null;

    /**
     * @var \Mustache_Engine
     */
    private $engine = null;

    public function __invoke(array $config = [])
    {
        $defaultDir = dirname(__DIR__, 2) . '/views';
        $options = [
            'loader' => new Mustache_Loader_FilesystemLoader($defaultDir),
            'extension' => '.mustache',
        ];

        return (new Templating())
            ->setTemplateDir($defaultDir)
            ->setEngine(new \Mustache_Engine($options));
    }

    /**
     * @return string
     */
    public function getTemplateDir()
    {
        return $this->templateDir;
    }

    /**
     * @param null $templateDir
     * @return Templating
     */
    public function setTemplateDir($templateDir): Templating
    {
        $this->templateDir = $templateDir;

        return $this;
    }

    /**
     * @return \Mustache_Engine
     */
    public function getEngine(): \Mustache_Engine
    {
        return $this->engine;
    }

    /**
     * @param \Mustache_Engine $engine
     * @return Templating
     */
    public function setEngine(\Mustache_Engine $engine): Templating
    {
        $this->engine = $engine;

        return $this;
    }

    /**
     * @param $template
     * @param array $context
     * @return string
     */
    public function render($template, array $context = [])
    {
        return $this->engine->render($template, $context);
    }
}
