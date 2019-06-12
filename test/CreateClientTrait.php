<?php

namespace Dambrogia\TiingoTest;

use Dotenv\Dotenv;
use Dambrogia\Tiingo\Client;

trait CreateClientTrait
{
    public function createClient($token = ''): Client
    {
        Dotenv::create(__DIR__.'/..')->load();

        if (! $token = empty($key) ? getenv('TIINGO_TOKEN') : $token) {
            throw new \Exception('Invalid token for testing.');
        }

        return new Client($token);
    }
}
