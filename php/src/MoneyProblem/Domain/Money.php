<?php

namespace MoneyProblem\Domain;


use phpDocumentor\Reflection\Types\Integer;

class Money
{
    private float $amount;
    private Currency $currency;

    public function __construct(float $amount, Currency $currency)
    {
        if ($amount < 0) {
            throw new \InvalidArgumentException('Cannot create negative money');
        }
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    public function hasCurrency(Currency $to): bool
    {
        return $this->currency == $to;
    }

    public function convert(float $rate, Currency $currency): Money
    {
        return new Money($this->amount * $rate, $currency);
    }
    
    public function add(Money $money): Money
    {
        if ($this->currency != $money->currency) {
            throw new \InvalidArgumentException('Cannot add money with different currencies');
        }
        return new Money($this->amount + $money->amount, $this->currency);
    }

    public function divide(int $money): Money
    {
        if ($money == 0) {
            throw new \LogicException('Cannot divide by zero');
        }
        return new Money($this->amount / $money, $this->currency);
    }

    public function multiply(int $money): Money
    {
        return new Money($this->amount * $money, $this->currency);
    }

}