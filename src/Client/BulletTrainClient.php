<?php
/**
 * Created by PhpStorm.
 * User: herve
 * Date: 24/11/2019
 * Time: 00:19
 */

namespace BulletTrain\Sample\Client;


use Guzzle\Http\EntityBodyInterface;
use GuzzleHttp\Client;

class BulletTrainClient
{
    const FLAG_URI = '/api/v1/flags/';

    /**
     * @var string
     */
    protected $apiKey = null;

    /**
     * @var string
     */
    protected $baseUri = null;

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var array
     */
    protected $headers = [];

    /**
     * @var Flag[]
     */
    protected $flags = null;

    protected $defaultFeatureFlags = null;

    public function __invoke(array $config = null)
    {
        $path = dirname(__DIR__, 2) . '/conf/';
        if (null === $config) {
            $config = include $path . 'client.php';
        }
        $defaultFeatureFlags = include $path . 'features.php';

        if (file_exists($path . 'client.local.php')) {
            $config = array_merge($config, include $path . 'client.local.php');
        }
        if (null === $config['API_KEY']) {
            throw new \Exception('BulletTrainClient API_KEY is not set');
        }
        if (null === $config['BASE_URI']) {
            throw new \Exception('BulletTrainClient BASE_URI is not set');
        }
        $client = new Client([
            'base_uri' => $config['BASE_URI']
        ]);
        $headers = [
            'headers' => [
                'x-environment-key' => $config['API_KEY'],
                'Content-Type' => 'application/json',
            ]
        ];

        return (new self())
            ->setApiKey($config['API_KEY'])
            ->setBaseUri($config['BASE_URI'])
            ->setClient($client)
            ->setHeaders($headers)
            ->setDefaultFeatureFlags($defaultFeatureFlags);
    }

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     * @return BulletTrainClient
     */
    public function setApiKey(string $apiKey): BulletTrainClient
    {
        $this->apiKey = $apiKey;
        return $this;
    }

    /**
     * @return string
     */
    public function getBaseUri(): string
    {
        return $this->baseUri;
    }

    /**
     * @param string $baseUri
     * @return BulletTrainClient
     */
    public function setBaseUri(string $baseUri): BulletTrainClient
    {
        $this->baseUri = $baseUri;
        return $this;
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * @param Client $client
     * @return BulletTrainClient
     */
    public function setClient(Client $client): BulletTrainClient
    {
        $this->client = $client;
        return $this;
    }


    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     * @return BulletTrainClient
     */
    public function setHeaders(array $headers): BulletTrainClient
    {
        $this->headers = $headers;
        return $this;
    }

    /**
     * @return null
     */
    public function getDefaultFeatureFlags()
    {
        return $this->defaultFeatureFlags;
    }

    /**
     * @param null $defaultFeatureFlags
     * @return BulletTrainClient
     */
    public function setDefaultFeatureFlags($defaultFeatureFlags): BulletTrainClient
    {
        $this->defaultFeatureFlags = $defaultFeatureFlags;
        return $this;
    }


    /**
     * @throws \Exception
     */
    protected function getFlags()
    {
        if (null !== $this->flags) {
            return $this->flags;
        }
        try {
            $data = json_decode(
                $this->client->get(
                    self::FLAG_URI,
                    $this->headers
                )->getBody()->getContents(),
                true
            );

            foreach ($data as $el) {
                $this->flags[$el['feature']['id']] = new Flag(
                    $el['feature']['id'],
                    $el['feature']['name'],
                    $el['feature']['description'] ?? $el['feature']['name'],
                    $el['enabled']
                );
            }
            return $this->flags;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function export()
    {
        try {
            $flags = $this->getFlags();
        } catch (\Exception $e) {
            return $this->getDefaultFeatureFlags() + ['warning' => $e->getMessage()];
        }
        $array = [];
        foreach ($flags as $flag) {
            $array['feature_' . $flag->getName()] = [
                'id'            => $flag->getId(),
                'name'          => $flag->getName(),
                'description'   => $flag->getDescription() ? $flag->getDescription() : $flag->getName(),
                'enabled'       => $flag->isEnabled(),
                'status'        => $flag->isEnabled() ? 'on' : 'off',
            ];
        }
        return $array;
    }

    /**
     * @param string $flagName
     * @return bool
     * @throws \Exception
     */
    public function isFlagEnabled(string $flagName)
    {
        try {
            foreach ($this->getFlags() as $flag) {
                if ($flag->getName() === $flagName) {
                    return $flag->isEnabled();
                }
            }
        } catch (\Exception $e) {
            return $this->getDefaultFeatureFlags();
        }
        return false;
    }
}
