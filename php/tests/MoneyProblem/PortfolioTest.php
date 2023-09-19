<?php

namespace Tests\MoneyProblem;

use MoneyProblem\Domain\Bank;
use MoneyProblem\Domain\Currency;
use MoneyProblem\Domain\Portfolio;
use PHPUnit\Framework\TestCase;

class PortfolioTest extends TestCase
{
    public function test_total_money_in_portfolio_without_exchange_rate()
    {
        // Arrange
        $bank = Bank::create(Currency::EUR(), Currency::USD(), 1.2);
        $portfolio = new Portfolio();
        $portfolio->add(10, Currency::USD());
        $portfolio->add(5, Currency::USD());

        // Act
        $result = $portfolio->evaluate(Currency::USD(), $bank);

        // Assert
        $this->assertEquals(15, $result);
    }

    public function test_total_money_in_portfolio_with_exchange_rate()
    {
        // Arrange
        $bank = Bank::create(Currency::EUR(), Currency::USD(), 1.2);
        $portfolio = new Portfolio();
        $portfolio->add(10, Currency::USD());
        $portfolio->add(5, Currency::EUR());

        // Act
        $result = $portfolio->evaluate(Currency::USD(), $bank);

        // Assert
        $this->assertEquals(17, $result);
    }
}
