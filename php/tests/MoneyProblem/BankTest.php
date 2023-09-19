<?php

namespace Tests\MoneyProblem;

use MoneyProblem\Domain\Bank;
use MoneyProblem\Domain\Currency;
use MoneyProblem\Domain\MissingExchangeRateException;
use PHPUnit\Framework\TestCase;

class BankTest extends TestCase
{

    public function test_convert_eur_to_usd_returns_float()
    {
        // Arrange
        $bank = Bank::create(Currency::EUR(), Currency::USD(), 1.2);

        // Act
        $result = $bank->convert(10, Currency::EUR(), Currency::USD());

        // Assert
        $this->assertEquals(12, $result);
    }

    public function test_convert_eur_to_eur_returns_same_value()
    {
        // Arrange
        $bank = Bank::create(Currency::EUR(), Currency::USD(), 1.2);

        // Act
        $result = $bank->convert(10, Currency::EUR(), Currency::EUR());

        // Assert
        $this->assertEquals(10, $result);
    }

    public function test_convert_throws_exception_on_missing_exchange_rate()
    {
        $this->expectException(MissingExchangeRateException::class);
        $this->expectExceptionMessage('EUR->KRW');

        $bank = Bank::create(Currency::EUR(), Currency::USD(), 1.2);
        $bank->convert(10, Currency::EUR(), Currency::KRW());
    }

    public function test_convert_with_different_exchange_rates_returns_different_floats()
    {
        // Arrange
        $bank = Bank::create(Currency::EUR(), Currency::USD(), 1.2);

        // Act
        $result = $bank->convert(10, Currency::EUR(), Currency::USD());

        // Assert
        $this->assertEquals(12, $result);

    }


}
