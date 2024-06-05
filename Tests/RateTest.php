<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use src\Rate;

class RateTest extends TestCase
{
    public function testGetRate()
    {
        $this->assertEquals(0.01, Rate::getRate(true));
        $this->assertEquals(0.02, Rate::getRate(false));
    }
}