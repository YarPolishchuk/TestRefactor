<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use src\Providers\Bin\BinList;
use RuntimeException;

class BinListTest extends TestCase
{
    public function testGetCurrency()
    {
        $mockClient = $this->createMock(Client::class);
        $mockResponse = new Response(200, [], '{"country":{"alpha2":"FR"}}');
        $mockClient->method('get')->willReturn($mockResponse);

        $binList = new BinList($mockClient);
        $currency = $binList->getCurrency('45717360');
        $this->assertEquals('FR', $currency);
    }

    public function testGetCurrencyInvalidBin()
    {
        $mockClient = $this->createMock(Client::class);
        $mockResponse = new Response(200, [], '{"country":null}');
        $mockClient->method('get')->willReturn($mockResponse);

        $binList = new BinList($mockClient);

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('ERROR: Bin is broken');

        $binList->getCurrency('invalid_bin');
    }
//    public function testGetCurrency()
//    {
//        $mockClient = $this->createMock(Client::class);
//        $mockResponse = new Response(200, [], '{"country":{"alpha2":"FR"}}');
//
//        $mockClient->method('get')->willReturn($mockResponse);
//
//        $reflection = new \ReflectionClass(BinList::class);
//        $property = $reflection->getProperty('client');
//        $property->setAccessible(true);
//        $property->setValue(null, $mockClient);
//
//        $currency = BinList::getCurrency('45717360');
//        $this->assertEquals('FR', $currency);
//    }
//
//    public function testGetCurrencyInvalidBin()
//    {
//        $mockClient = $this->createMock(Client::class);
//        $mockResponse = new Response(200, [], '{"country":null}');
//
//        $mockClient->method('get')->willReturn($mockResponse);
//
//        $reflection = new \ReflectionClass(BinList::class);
//        $property = $reflection->getProperty('client');
//        $property->setAccessible(true);
//        $property->setValue(null, $mockClient);
//
//        $this->expectException(RuntimeException::class);
//        $this->expectExceptionMessage('ERROR: Bin is brocken');
//
//        BinList::getCurrency('invalid_bin');
//    }
}
