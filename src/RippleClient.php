<?php

namespace IEXBase\RippleAPI;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class RippleClient
{
    /**
     * @const string Ripple API URL
     */
    const BASE_REST_URL = 'https://data.ripple.com/v2';

    /**
     * @const string Ripple RPC URL
     */
    const BASE_RPC_URL = 'https://s1.ripple.com:51234';

    /**
     * Base WSS Node
     *
     * @var string
     */
    protected string $WSSNode;

    /**
     * Guzzle Http Client
     *
     * @var Client
     */
    protected Client $client;

    /**
     * Number of requests
     *
     * @var int
     */
    protected int $requestCount = 0;

    /**
     * Create a new RippleClient object
     *
     * @param array $nodes
     */
    public function __construct($nodes = [])
    {
        $this->client = new Client();

        if (array_key_exists('wss_node', $nodes)) {
            $this->WSSNode = $nodes['wss_node'];
        }
    }

    /**
     * We send requests to the Ripple server
     *
     * @param $method
     * @param $path
     * @param array $options
     * @param boolean $api
     * @return array
     */
    public function sendRequest($method, $path, $options = [], $api = true)
    {
        $this->requestCount++;
        $url = sprintf('%s%s', ($api == true) ? self::BASE_REST_URL : self::BASE_RPC_URL, $path);

        try {
            if ($api == true) {
                $response = $this->client->request($method, $url, ['query' => $options]);
            } else {

                $body = [
                    'id' => $this->requestCount,
                    'method' => $method,
                    'json_rpc' => '2.0',
                ];

                if (is_array($options) and !empty($options)) {
                    $body['params'] = [$options];
                }

                $response = $this->client->request('POST', $url, [
                    'body' => json_encode($body)
                ]);
            }
            return $this->toArray($response->getBody()->getContents());

        } catch (GuzzleException $exception) {
            return ['result' => 'error', 'message' => $exception->getMessage()];
        }
    }

    /**
     * Send requests to the Ripple WSS server
     *
     * @param $method
     * @param $path
     * @param array $options
     * @return array
     */
    public function sendRequestWss($method, $path, $options = [])
    {
        $this->requestCount++;
        try {
            $url = sprintf('%s%s', $this->WSSNode, $path);

            $response = $this->client->request($method, $url, ['query' => $options]);
            return $this->toArray($response->getBody()->getContents());

        } catch (GuzzleException $exception) {
            return ['result' => 'error', 'message' => $exception->getMessage()];
        }
    }

    /**
     * Convert any response to an array
     *
     * @param $data
     * @return array|bool|mixed|null
     */
    public function toArray($data)
    {
        $decodedBody = json_decode($data, true);

        if ($decodedBody === null) {
            $decodedBody = [];
        } elseif (is_bool($decodedBody)) {
            $decodedBody = ['success' => $decodedBody];
        }

        if (!is_array($decodedBody)) {
            $decodedBody = [];
        }

        return $decodedBody;
    }
}
