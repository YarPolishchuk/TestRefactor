<?php

namespace src\Providers\Rates;

use GuzzleHttp\Client;

class ExangeRates
{
    const RATE_URL = 'http://api.exchangeratesapi.io/latest?access_key=';

    const RATE_TOKEN = '9c78301bd7fd26ed461f05896b6ba707';

    /**
     * @param $currency
     * @return float
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function getRate($currency): float
    {
        $client = new Client();
        $response = $client->get(self::RATE_URL . self::RATE_TOKEN);

        $rateData = json_decode($response->getBody());

        return $rateData->rates->{$currency};
    }
}