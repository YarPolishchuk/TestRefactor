<?php

namespace src;

use Exception;
use src\Providers\Bin\BinList;
use src\Providers\Rates\ExangeRates;

class Comission
{
    private array $countries = ['AT', 'BE', 'BG', 'CY', 'CZ', 'DE', 'DK', 'EE',
        'ES', 'FI', 'FR', 'GR', 'HR', 'HU', 'IE', 'IT', 'LT', 'LU',
        'LV', 'MT', 'NL', 'PO', 'PT', 'RO', 'SE', 'SI', 'SK'];

    /**
     * @param $inputData
     * @return void
     * @throws Exception
     */
    public function calculate($inputData): void
    {
        foreach ($inputData as $data) {

            echo $this->processing($data) . PHP_EOL;
        }

    }

    /**
     * @param $data
     * @return float
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function processing($data): float
    {
        try {
            $currency = BinList::getCurrency($data->bin);
            $rate = ExangeRates::getRate($data->currency);
            $isEu = $this->isEu($currency);

            $amntFixed = $data->amount;
            if ($data->currency != 'EUR' or $rate > 0) {
                $amntFixed = $data->amount / $rate;
            }
            return round($amntFixed * Rate::getRate($isEu), 2);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param string $currency
     * @return bool
     */
    private function isEu(string $currency): bool
    {
        return in_array($currency, $this->countries);
    }

}