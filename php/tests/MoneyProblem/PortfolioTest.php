<?php

namespace Tests\MoneyProblem;

use MoneyProblem\Domain\Bank;
use MoneyProblem\Domain\Currency;
use MoneyProblem\Domain\MissingExchangeRateException;
use MoneyProblem\Domain\Portfolio;
use Pitchart\Phlunit\Check;
use PHPUnit\Framework\TestCase;

class PortfolioTest extends TestCase
{
    /**
     * Devise identique sans taux de change
     *
     * @return void
     */
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

    /**
     * Devise différente besoin de taux de change
     *
     * @return void
     */
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

    /**
     * Devise différentes mais pas de taux de change
     *
     * @return void
     */
    public function test_total_money_different_current_in_portfolio_without_exchange_rate()
    {
        // Arrange
        $bank = Bank::create(Currency::USD(), Currency::EUR(), 1.2);
        $portfolio = new Portfolio();
        $portfolio->add(10, Currency::USD());
        $portfolio->add(10, Currency::EUR());

        // Act
        Check::thatCall(fn() => $portfolio->evaluate(Currency::KRW(), $bank))->throws(MissingExchangeRateException::class)->isDescribedBy("USD->KRW");
    }

    /**
     * Evaluer dans une monnaie qui n'est pas dans le portefeuille
     *
     * @return void
     */
    public function test_evaluate_currency_that_is_not_in_portfolio(){
        // Arrange
        $bank = Bank::create(Currency::EUR(), Currency::KRW(), 1427.16);
        $bank->addEchangeRate(Currency::USD(), Currency::KRW(), 1352.7);
        $portfolio = new Portfolio();
        $portfolio->add(10, Currency::EUR());
        $portfolio->add(5, Currency::USD());

        // Act
        $res = $portfolio->evaluate(Currency::KRW(), $bank);

        // Assert
        $this->assertEquals(21035.1, $res);
    }

    /**
     * Evaluer que le portefeuille est vide
     *
     * @return void
     */
    public function test_portfolio_is_empty(){
        // Arrange
        $bank = Bank::create(Currency::EUR(), Currency::KRW(), 1427.16);
        $portfolio = new Portfolio();

        // Act
        $res = $portfolio->evaluate(Currency::KRW(), $bank);

        // Assert
        $this->assertEquals(0, $res);
    }

}
