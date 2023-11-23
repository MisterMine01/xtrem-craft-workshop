<?php

namespace Tests\MoneyProblem;

use MoneyProblem\Domain\Bank;
use MoneyProblem\Domain\Currency;


class BankBuilder
{

    private $pivotCurrency;
    private $exchangeRates = [];

    private function __construct()
    {
        $this->pivotCurrency = Currency::EUR();
    }

    public static function ABankCreation()
    {
        return new BankBuilder();
    }


    public function WithPivotCurrency(Currency $currency): BankBuilder
    {
        $this->pivotCurrency = $currency;
        return $this;
    }

    public function WithExchangeRate(Currency $currency, float $rate): BankBuilder
    {
        $this->exchangeRates[$currency->__toString()] = $rate;
        return $this;
    }



    public function Build()
    {
        $key = array_keys($this->exchangeRates)[0];

        $bank = Bank::create($this->pivotCurrency, Currency::from($key), $this->exchangeRates[$key]);
        return $bank;
    }
}
