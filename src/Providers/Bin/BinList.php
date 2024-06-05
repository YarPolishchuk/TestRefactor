<?php

namespace src\Providers\Bin;

use GuzzleHttp\Client;
use RuntimeException;

class BinList
{
    const BIN_URL = 'https://lookup.binlist.net/';

    /**
     * @param $bin
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function getCurrency($bin): string
    {
        $client = new Client();
        $response = $client->get(self::BIN_URL . $bin);
        $binlist = json_decode($response->getBody());
        if ($binlist->country != NULL) {
            throw new RuntimeException('ERROR: Bin is brocken' . PHP_EOL);
        }
        return $binlist->country->alpha2;

    }
}