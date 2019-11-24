<?php
/**
 * Created by PhpStorm.
 * User: herve
 * Date: 24/11/2019
 * Time: 00:19
 */

namespace BulletTrain\Sample\Client;


use Guzzle\Http\Client;

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
        $client = new Client($config['BASE_URI']);
        $this->headers = ['headers' => [
        'x-environment-key' => $config['API_KEY']
    ]];

        return (new self())
            ->setApiKey($config['API_KEY'])
            ->setBaseUri($config['BASE_URI'])
            ->setClient($client);
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
     * @return \Guzzle\Http\Message\RequestInterface
     */
    public function getFlags()
    {
        $request = $this->client->get(self::FLAG_URI, $this->headers);
        return $this->client->send($request)->getBody(true);
    }
}
