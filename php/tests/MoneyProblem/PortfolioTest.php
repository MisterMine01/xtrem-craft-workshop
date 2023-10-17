<?php

namespace Tests\MoneyProblem;

use MoneyProblem\Domain\Bank;
use MoneyProblem\Domain\Currency;
use MoneyProblem\Domain\Portfolio;
use MoneyProblem\Domain\MissingExchangeRateException;
use Pitchart\Phlunit\Check;
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

    public function test_total_money_with_different_in_portfolio_with_exchange_rate()
    {
        // Arrange
        $bank = Bank::create(Currency::EUR(), Currency::USD(), 1.2);
        $portfolio = new Portfolio();
        $portfolio->add(5, Currency::USD());
        $portfolio->add(10, Currency::EUR());

        // Act
        $result = $portfolio->evaluate(Currency::USD(), $bank);

        // Assert
        $this->assertEquals(17, $result);
    }
    
    public function test_total_money_different_current_in_portfolio_without_exchange_rate()
    {
        // Arrange
        $bank = Bank::create(Currency::USD(), Currency::EUR(), 1.2);
        $portfolio = new Portfolio();
        $portfolio->add(10, Currency::USD());
        $portfolio->add(10, Currency::EUR());

        //$this->expectException(\MissingExchangeRateException::class);
        //$this->expectExceptionMessage("USD->KRW");
        // Act

        
        Check::thatCall(fn() => $portfolio->evaluate(Currency::KRW(), $bank))->throws(MissingExchangeRateException::class)->isDescribedBy("USD->KRW");
       
        
        
    }



}
