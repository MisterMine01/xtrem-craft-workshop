<?php

namespace Tests\MoneyProblem;

use http\Exception\InvalidArgumentException;
use MoneyProblem\Domain\Money;
use MoneyProblem\Domain\Currency;
use PHPUnit\Framework\TestCase;

class MoneyTest extends TestCase
{
    public function testAddWithSameCurrencies() {
        $money = new Money(5, Currency::USD());

        $sum = $money->add(new Money(10, Currency::USD()));

        $this->assertEquals($sum, new Money(15, Currency::USD()));
        $this->assertEquals($money, new Money(5, Currency::USD()));
    }

    public function testAddDifferentCurrency() {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Cannot add money with different currencies');

        $money = new Money(5, Currency::USD());

        $money->add(new Money(10, Currency::EUR()));

    }
}