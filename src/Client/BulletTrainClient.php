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

    public function __invoke(array $config = null)
    {
        if (null === $config) {
            $config = include dirname(__DIR__, 2) . '/conf/client.php';
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
            ->setHeaders($headers);
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

//    public function __construct(Client $client, string $apiKey, string $baseUri)
//    {
//        $this->client = $client;
//        $this->apiKey = $apiKey;
//        $this->baseUri = $baseUri;
//    }



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
     * @throws \Exception
     */
    public function getFlags()
    {
        if (null !== $this->flags) {
            return $this->flags;
        }
        try {
            $data = json_decode($this->client->get(self::FLAG_URI, $this->headers)->getBody()->getContents(), true);
            foreach ($data as $el) {
                $this->flags[$el['feature']['id']] = new Flag($el['feature']['id'], $el['feature']['name'], $el['enabled']);
            }
            return $this->flags;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function exportFlags()
    {
        try {
            $flags = $this->getFlags();
        } catch (\Exception $e) {
            return ['warning' => $e->getMessage()];
        }
        $array = [];
        foreach ($flags as $flag) {
            $array['feature_' . $flag->getName()] = $flag->isEnabled();
        }
        return $array;
    }
}
