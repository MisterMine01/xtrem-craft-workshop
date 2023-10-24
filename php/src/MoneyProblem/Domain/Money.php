<?php

namespace MoneyProblem\Domain;

class Money
{
    private float $amount;
    private Currency $currency;

    public function __construct(float $amount, Currency $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public function add(float $amount, Currency $currency) {

        
        $new_money = new Money($amount, $currency);

        return $new_money;
    }

}