<?php

namespace Dambrogia\TiingoTest;

use PHPUnit\Framework\TestCase;
use Dambrogia\TiingoTest\CreateClientTrait;

final class ClientTest extends TestCase
{
    use CreateClientTrait;

    /**
     * Assert the class can be instantiated.
     * @return void
     */
    public function testCreate(): void
    {
        $client = $this->createClient();

        $status = $client->meta('aapl')->getStatusCode();
        $this->assertEquals('200', $status);

        $status = $client->prices('aapl')->getStatusCode();
        $this->assertEquals('200', $status);
    }
}
