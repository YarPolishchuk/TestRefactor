<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use src\Providers\Rates\ExangeRates;

class ExangeRatesTest extends TestCase
{
    public function testGetRate()
    {
        $mockClient = $this->createMock(Client::class);
        $mockResponse = new Response(200, [], '{"rates":{"USD":1.09}}');
        $mockClient->method('get')->willReturn($mockResponse);

        $exchangeRates = new ExangeRates($mockClient);
        $rate = $exchangeRates->getRate('USD');
        $this->assertEquals(1.09, round($rate, 2));
    }
}