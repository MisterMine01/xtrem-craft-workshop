<?php

namespace MoneyProblem\Domain;

use function array_key_exists;

class Bank
{
    private array $exchangeRates;
    private Currency $pivotCurrency;

    /**
     * @param array $exchangeRates
     */
    public function __construct(Currency $pivotCurrency, array $exchangeRates = [])
    {
        $this->exchangeRates = $exchangeRates;
        $this->pivotCurrency = $pivotCurrency;
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
        $bank = new Bank($currency1, []);
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

    private function getExchangeRate(Currency $currency1, Currency $currency2): ?float
    {
        if (!isset($this->exchangeRates[($currency1 . '->' . $currency2)])) {
            return null;
        }
        return $this->exchangeRates[($currency1 . '->' . $currency2)];
    }

    /**
     * @param Money $money
     * @param Currency $currency2
     * @return Money
     * @throws MissingExchangeRateException
     */
    public function convertMoney(Money $money, Currency $currency2): Money
    {
        if ($money->hasCurrency($currency2)) {
            return new Money($money->getAmount(), $currency2);
        }

        if (!array_key_exists($money->getCurrency() . '->' . $this->pivotCurrency, $this->exchangeRates) ||
            !array_key_exists($this->pivotCurrency . '->' . $currency2, $this->exchangeRates)) {
            throw new MissingExchangeRateException($money->getCurrency(), $currency2);
        }

        return $money
                ->convert($this->getExchangeRate($money->getCurrency(), $this->pivotCurrency), $this->pivotCurrency)
                ->convert($this->getExchangeRate($this->pivotCurrency, $currency2), $currency2);
    }


          

}
