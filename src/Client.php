<?php

namespace Dambrogia\Tiingo;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Psr7\Response;

class Client
{
    protected $token;
    protected $client;

    const BASE_URL = 'https://api.tiingo.com/tiingo/';

    public function __construct(string $token)
    {
        $this->token = $token;
        $this->client = new HttpClient([ 'base_uri' => self::BASE_URL ]);
    }

    /**
     * Get daily meta data for the current ticker symbol.
     * @param string $ticker
     * @return Response
     */
    public function meta(string $ticker): Response
    {
        $q = $this->params();
        return $this->request('GET', "daily/{$ticker}?{$q}");
    }

    /**
     * Get daily meta data for the current ticker symbol.
     * @param string $ticker
     * @return Response
     */
    public function prices(string $ticker, $options = []): Response
    {
        $q = $this->params();
        return $this->request('GET', "daily/{$ticker}/prices?{$q}");
    }

    /**
     * Return the default token params. Optionally add parameters to query
     * string.
     * @param array $additional
     * @return string
     */
    protected function params(array $additional = []): string
    {
        $params = array_merge(['token' => $this->token], $additional);
        return http_build_query($params);
    }

    /**
     * Make a request with the default headers. Allow for overwriting header.
     * @param string $verb
     * @param string $endpoint
     * @param array $options
     * @return Response
     */
    protected function request(string $verb, string $endpoint, array $options = []): Response
    {
        $default = [ 'headers' => [ 'Content-type' =>  'application/json' ] ];
        $options = array_merge($default, $options);

        return $this->client->request($verb, $endpoint, $options);
    }
}
