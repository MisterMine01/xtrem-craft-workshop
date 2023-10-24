<?php

namespace Tests\MoneyProblem;

use MoneyProblem\Domain\Money;
use MoneyProblem\Domain\Currency;
use PHPUnit\Framework\TestCase;

class MoneyTest extends TestCase
{
    public function testAdd() {
        $money = new Money(5, Currency::USD());
        
        $sum = $money->add(10, Currency::USD());

        $this->assertEquals($sum, new Money(15, Currency::USD()));
        $this->assertEquals($money, new Money(5, Currency::USD()));
    }
}