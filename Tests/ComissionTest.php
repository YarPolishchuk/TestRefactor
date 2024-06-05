<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use src\Providers\Bin\BinList;
use src\Providers\Rates\ExangeRates;
use src\Comission;
use src\Rate;

class ComissionTest extends TestCase
{
    public function testProcessing()
    {
        $data = json_decode('{"bin":"45717360","amount":"100.00","currency":"EUR"}');

        $binListMock = $this->createMock(BinList::class);
        $binListMock->method('getCurrency')->willReturn('FR');

        $exchangeRatesMock = $this->createMock(ExangeRates::class);
        $exchangeRatesMock->method('getRate')->willReturn(1.0);

        $rateMock = $this->createMock(Rate::class);
        $rateMock->method('getRate')->willReturn(0.01);

        $comission = new Comission();
        $result = $comission->processing($data);

        $this->assertEquals(1.0, $result);
    }

}
