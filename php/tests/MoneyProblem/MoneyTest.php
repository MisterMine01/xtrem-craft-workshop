<?php

namespace Tests\MoneyProblem\Domain;

use MoneyProblem\Domain\Currency;
use MoneyProblem\Domain\MoneyCalculator;
use PHPUnit\Framework\TestCase;

class MoneyTest extends TestCase
{
    public function test_add_in_usd_returns_value()
    {
        // Act 
        $moneyCalculator = MoneyCalculator::add(5, Currency::USD(), 10);

        // Assert
        $this->assertIsFloat($moneyCalculator);
        $this->assertNotNull($moneyCalculator);

    }

    public function test_multiply_in_euros_returns_positive_number()
    {
        // Act
        $moneyCalculator = MoneyCalculator::multiply(10, Currency::USD(), 2);

        // Assert
        $this->assertLessThan($moneyCalculator, 0);
    }

    public function test_divide_in_korean_won_returns_float()
    {
        // Act
        $moneyCalcultor = MoneyCalculator::divide(4002, Currency::USD(), 4);

        // Assert
        $this->assertEquals($moneyCalcultor, 1000.5);
    }
}
