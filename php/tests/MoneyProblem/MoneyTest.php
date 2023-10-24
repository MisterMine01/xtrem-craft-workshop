<?php

namespace Tests\MoneyProblem;

use MoneyProblem\Domain\Money;
use MoneyProblem\Domain\Currency;
use PHPUnit\Framework\TestCase;

class MoneyTest extends TestCase
{
    public function testCreateNegativeMoney()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Cannot create negative money');

        new Money(-5, Currency::USD());
    }

    public function testAddWithSameCurrencies()
    {
        $money = new Money(5, Currency::USD());

        $sum = $money->add(new Money(10, Currency::USD()));

        $this->assertEquals($sum, new Money(15, Currency::USD()));
        $this->assertEquals($money, new Money(5, Currency::USD()));
    }

    public function testAddDifferentCurrency()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Cannot add money with different currencies');

        $money = new Money(5, Currency::USD());

        $money->add(new Money(10, Currency::EUR()));
    }

    public function testDivideCurrency()
    {
        $money = new Money(4002, Currency::KRW());

        $sum = $money->divide(4);

        $this->assertEquals($sum, new Money(1000.5, Currency::KRW()));
    }

    public function testDivideZeroCurrency()
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage('Cannot divide by zero');

        $money = new Money(4002, Currency::KRW());

        $money->divide(0);
    }

    public function testMultiplyCurrency()
    {
        $money = new Money(4002, Currency::KRW());

        $fact = $money->multiply(2);

        $this->assertEquals($fact, new Money(8004, Currency::KRW()));
    }
}
