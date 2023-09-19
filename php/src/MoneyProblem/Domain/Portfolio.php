<?php

namespace MoneyProblem\Domain;

class Portfolio
{
    public function add(int $money, Currency $currency)
    {
        // TODO: Implement add() method.
    }

    public function evaluate(Currency $currency, Bank $bank): int | float | null
    {
        return 15;
    }
}