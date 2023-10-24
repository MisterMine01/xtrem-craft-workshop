<?php

namespace Tests\MoneyProblem;

use MoneyProblem\Domain\Bank;
use MoneyProblem\Domain\Currency;
use MoneyProblem\Domain\MissingExchangeRateException;
use PHPUnit\Framework\TestCase;

class BankTest extends TestCase
{

    /**
     * Fonction qui test la conversion de euro à dollar et qui retourne un float
     * @return void
     * @throws MissingExchangeRateException
     */
    public function test_convert_eur_to_usd_returns_float()
    {
        // Arrange
        $bank = Bank::create(Currency::EUR(), Currency::USD(), 1.2);

        // Act
        $result = $bank->convert(10, Currency::EUR(), Currency::USD());

        // Assert
        $this->assertEquals(12, $result);
    }

    /**
     * Fonction qui test de euro à euro et qui retourne la même valeur
     * @return void
     * @throws MissingExchangeRateException
     */
    public function test_convert_eur_to_eur_returns_same_value()
    {
        // Arrange
        $bank = Bank::create(Currency::EUR(), Currency::USD(), 1.2);

        // Act
        $result = $bank->convert(10, Currency::EUR(), Currency::EUR());

        // Assert
        $this->assertEquals(10, $result);
    }

    /**
     * Fonction qui test la convertion et lève une exception en cas de taux d'échange manquant
     * @return void
     * @throws MissingExchangeRateException
     */
    public function test_convert_throws_exception_on_missing_exchange_rate()
    {
        $this->expectException(MissingExchangeRateException::class);
        $this->expectExceptionMessage('EUR->KRW');

        $bank = Bank::create(Currency::EUR(), Currency::USD(), 1.2);
        $bank->convert(10, Currency::EUR(), Currency::KRW());
    }

    /**
     * Fonction qui test la convertion avec des taux de change différents et qui retourne des float différents
     * @return void
     * @throws MissingExchangeRateException
     */
    public function test_convert_with_different_exchange_rates_returns_different_floats()
    {
        // Arrange
        $bank = Bank::create(Currency::EUR(), Currency::USD(), 1.2);
        $result = $bank->convert(10, Currency::EUR(), Currency::USD());
        $this->assertEquals(12, $result);

        // Act
        $bank->addEchangeRate(Currency::EUR(), Currency::USD(), 1.3);
        $result = $bank->convert(10, Currency::EUR(), Currency::USD());

        // Assert
        $this->assertEquals(13, $result);

    }

}