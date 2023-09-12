<?php

namespace MoneyProblem\Domain;

class MoneyCalculator
{
    /**
     * Add two amounts of the same currency
     * @param float $amount
     * @param Currency $currency
     * @param float $amount2
     * @return float
     */
    public static function add(float $amount, Currency $currency, float $amount2): float
    {
        return $amount + $amount2;
    }

    /**
     * Subtract two amounts of the same currency
     * @param float $amount
     * @param Currency $currency
     * @param float $amount2
     * @return float
     */
    public static function times(float $amount, Currency $currency, int $value): float
    {
        return $amount * $value;
    }

    /**
     * Divide two amounts of the same currency
     */
    public static function divide(float $amount, Currency $currency, int $value): float
    {
        return $amount / $value;
    }
}