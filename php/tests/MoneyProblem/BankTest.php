<?php

namespace Tests\MoneyProblem;

use MoneyProblem\Domain\Currency;
use MoneyProblem\Domain\MissingExchangeRateException;
use MoneyProblem\Domain\Money;
use PHPUnit\Framework\TestCase;

class BankTest extends TestCase
{

    /**
     * Fonction qui test la conversion de euro à dollar et qui retourne un float
     * @return void
     * @throws MissingExchangeRateException
     */
    public function test_convert_money_eur_to_usd_returns_float()
    {
        // Arrange
        $bank = BankBuilder::ABankCreation()
            ->WithPivotCurrency(Currency::EUR())
            ->WithExchangeRate(Currency::USD(), 1.2)
            ->Build();

        // Act
        $result = $bank->convertMoney(new Money(10, Currency::EUR()), Currency::USD());

        // Assert
        $this->assertEquals(new Money(12, Currency::USD()), $result);
    }

    /**
     * Fonction qui test de euro à euro et qui retourne la même valeur
     * @return void
     * @throws MissingExchangeRateException
     */
    public function test_convert_money_eur_to_eur_returns_same_value()
    {
        // Arrange
        $bank = BankBuilder::ABankCreation()
            ->WithPivotCurrency(Currency::EUR())
            ->WithExchangeRate(Currency::USD(), 1.2)
            ->Build();

        // Act
        $result = $bank->convertMoney(new Money(10, Currency::EUR()), Currency::EUR());

        // Assert
        $this->assertEquals(new Money(10, Currency::EUR()), $result);
    }

    /**
     * Fonction qui test la convertion et lève une exception en cas de taux d'échange manquant
     * @return void
     * @throws MissingExchangeRateException
     */
    public function test_convert_money_throws_exception_on_missing_exchange_rate()
    {
        $this->expectException(MissingExchangeRateException::class);
        $this->expectExceptionMessage('EUR->KRW');

        $bank = BankBuilder::ABankCreation()
            ->WithPivotCurrency(Currency::EUR())
            ->WithExchangeRate(Currency::USD(), 1.2)
            ->Build();

        $bank->convertMoney(new Money(10, Currency::EUR()), Currency::KRW());

    }

    /**
     * Fonction qui test la convertion avec des taux de change différents et qui retourne des float différents
     * @return void
     * @throws MissingExchangeRateException
     */
    public function test_convert_money_with_different_exchange_rates_returns_different_floats()
    {
        // Arrange
        $bank = BankBuilder::ABankCreation()
            ->WithPivotCurrency(Currency::EUR())
            ->WithExchangeRate(Currency::USD(), 1.2)
            ->Build();
        $result = $bank->convertMoney(new Money(10, Currency::EUR()), Currency::USD());
        $this->assertEquals(new Money(12, Currency::USD()), $result);

        // Act
        $bank->addEchangeRate(Currency::EUR(), Currency::USD(), 1.3);
        $result = $bank->convertMoney(new Money(10, Currency::EUR()), Currency::USD());

        // Assert
        $this->assertEquals(new Money(13, Currency::USD()), $result);
    }
}
