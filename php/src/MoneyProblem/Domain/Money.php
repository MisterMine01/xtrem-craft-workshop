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

    public function add(Money $money): Money
    {
        if ($this->currency !== $money->currency) {
            throw new \InvalidArgumentException('Cannot add money with different currencies');
        }
        return new Money($this->amount + $money->amount, $this->currency);
    }

}