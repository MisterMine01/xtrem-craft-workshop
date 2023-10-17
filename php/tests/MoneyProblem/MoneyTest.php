<?php

namespace Tests\MoneyProblem;

use MoneyProblem\Domain\Currency;
use MoneyProblem\Domain\MoneyCalculator;
use PHPUnit\Framework\TestCase;

class MoneyTest extends TestCase
{
    /**
     * Fonction qui test l'addition de deux valeurs en dollars et qui retourne un float
     * @return void
     */
    public function test_add_in_usd_returns_value()
    {
        // Act 
        $moneyCalculator = MoneyCalculator::add(5, Currency::USD(), 10);

        // Assert
        $this->assertEquals(15, $moneyCalculator);
    }

    /**
     * Fonction qui test la multiplication d'une valeur en dollars par 2 et qui retourne un float
     * @return void
     */
    public function test_multiply_in_euros_returns_positive_number()
    {
        // Act
        $moneyCalculator = MoneyCalculator::multiply(10, Currency::USD(), 2);

        // Assert
        $this->assertEquals(20, $moneyCalculator);
    }

    /**
     * Fonction qui test la division de'une valeur en Won par 4 et qui retourne un float
     * @return void
     */
    public function test_divide_in_korean_won_returns_float()
    {
        // Act
        $moneyCalculator = MoneyCalculator::divide(4002, Currency::USD(), 4);

        // Assert
        $this->assertEquals(1000.5, $moneyCalculator);
    }
}
