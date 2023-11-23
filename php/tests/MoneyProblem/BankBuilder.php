<?php

namespace MoneyProblem\Domain;
use MoneyProblem\Domain\Bank;
use MoneyProblem\Domain\Currency;


class BankBuilder
{
    

    private Currency $pivotCurrency = Currency::EUR();
    private $exchangeRates = [];
            

    public static function APropertyCreation(){
       new BankBuilder();
    } 
    

    public function WithPivotCurrency(Currency $currency) : BankBuilder
    {
        $this->pivotCurrency = $currency;
        return $this;
    }

public function WithExchangeRate(Currency $currency, float $rate) : BankBuilder
{
    $this->exchangeRates[$currency->__toString()] = $rate;
    return $this;
}



public function Build() 
{
    $key = array_keys($this->exchangeRates)[0];

    $bank = Bank::create($this->pivotCurrency, Currency::from($key)  , $this->exchangeRates[$key]);
    return $bank;
}
}