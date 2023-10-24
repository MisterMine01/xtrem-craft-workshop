<?php

namespace MoneyProblem\Domain;

class Portfolio
{
    private array $_money = [];

    public function add(int $money, Currency $currency)
    {
        if (!isset($this->_money[(string)$currency])) {
            $this->_money[(string)$currency] = ['amount' => 0, 'currency' => $currency];
        }
        $this->_money[(string)$currency]["amount"] += $money;
    }

    public function evaluate(Currency $currency, Bank $bank): int | float | null
    {
        $total = 0;
        foreach ($this->_money as $key => $value) {
            $total += $bank->convert(new Money($value["amount"], $value["currency"]), $currency);
        }
        return $total;
    }
}