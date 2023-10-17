<?php

namespace MoneyProblem\Domain;

use function array_key_exists;

class Bank
{
    private array $exchangeRates;

    /**
     * @param array $exchangeRates
     */
    private function __construct(array $exchangeRates = [])
    {
        $this->exchangeRates = $exchangeRates;
    }

    /**
     * Create a bank with a single exchange rate
     * @param Currency $currency1
     * @param Currency $currency2
     * @param float $rate
     * @return Bank
     */
    public static function create(Currency $currency1, Currency $currency2, float $rate)
    {
        $bank = new Bank([]);
        $bank->addEchangeRate($currency1, $currency2, $rate);

        return $bank;
    }

    /**
     * Add an exchange rate to the bank
     * @param Currency $currency1
     * @param Currency $currency2
     * @param float $rate
     * @return void
     */
    public function addEchangeRate(Currency $currency1, Currency $currency2, float $rate): void
    {
        $this->exchangeRates[($currency1 . '->' . $currency2)] = $rate;
    }

    /**
     * Convert an amount from one currency to another currency
     * @param float $amount
     * @param Currency $currency1
     * @param Currency $currency2
     * @return float
     * @throws MissingExchangeRateException
     */
    public function convert(float $amount, Currency $currency1, Currency $currency2): float
    {
        if ($currency1 == $currency2) {
            return $amount;
        }
        if (!array_key_exists($currency1 . '->' . $currency2, $this->exchangeRates)){
            throw new MissingExchangeRateException($currency1, $currency2);
        }
        return $amount * $this->exchangeRates[($currency1 . '->' . $currency2)];
    }

}