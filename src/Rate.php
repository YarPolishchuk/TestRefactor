<?php

namespace src;

class Rate
{

    /**
     * @param bool $isEu
     * @return float
     */
    public static function getRate(bool $isEu): float
    {
        return $isEu ? 0.01 : 0.02;
    }
}