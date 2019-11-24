<?php
/**
 * Created by PhpStorm.
 * User: herve
 * Date: 24/11/2019
 * Time: 08:37
 */

namespace BulletTrain\Sample\Client;


class Flag
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var boolean
     */
    protected $isEnabled;

    /**
     * Flag constructor.
     * @param int $id
     * @param string $name
     * @param bool $isEnabled
     */
    public function __construct(int $id, string $name, bool $isEnabled)
    {
        $this->id = $id;
        $this->name = $name;
        $this->isEnabled = $isEnabled;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->isEnabled;
    }
}