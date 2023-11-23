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

    public static function createBankPivot(Currency $currency)
    {
        // TODO: Implement createBankPivot() method.
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

    public function addPivotRate(Currency $currency, float $rate)
    {
        // TODO: Implement addPivotRate() method.
    }

    public function getPivot()
    {
        // TODO: Implement getPivot() method.
    }

    public function getPivotRate(Currency $currency)
    {
        // TODO: Implement getPivotRate() method.
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
        if (!array_key_exists($money->getCurrency() . '->' . $currency2, $this->exchangeRates)) {
            throw new MissingExchangeRateException($money->getCurrency(), $currency2);
        }
        return $money->convert($this->getExchangeRate($money->getCurrency(), $currency2), $currency2);
    }


          

}
