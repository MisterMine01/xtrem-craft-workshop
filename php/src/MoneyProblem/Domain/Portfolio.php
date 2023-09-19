<?php

namespace MoneyProblem\Domain;

class Portfolio
{
    public static function create()
    {
        return new self();
    }

    function add(int $money, Currency $currency)
    {
        // TODO: Implement add() method.
    }

    function evaluate(Currency $currency, Bank $bank): int
    {
        return 15;
    }
}