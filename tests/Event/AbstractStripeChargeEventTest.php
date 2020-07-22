<?php

/*
 * This file is part of the Serendipity HQ Stripe Bundle.
 *
 * Copyright (c) Adamo Aerendir Crespi <aerendir@serendipityhq.com>.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SerendipityHQ\Bundle\StripeBundle\Tests\Model;

use PHPUnit\Framework\TestCase;
use SerendipityHQ\Bundle\StripeBundle\Event\StripeChargeCreateEvent;
use SerendipityHQ\Bundle\StripeBundle\Model\StripeLocalCharge;
use SerendipityHQ\Bundle\StripeBundle\Model\StripeLocalCustomer;
use SerendipityHQ\Component\ValueObjects\Money\Money;

/**
 * Tests the AbstractStripeChargeEvent.
 *
 * @author Adamo Aerendir Crespi <hello@aerendir.me>
 */
class AbstractStripeChargeEventTest extends TestCase
{
    public function testAbstractStripeChargeEvent()
    {
        $mockCustomer = $this->createMock(StripeLocalCustomer::class);
        $mockAmount   = $this-- > $this->createMock(Money::class);
        $mockCharge   = $this->createMock(StripeLocalCharge::class);
        $mockCharge->method('getAmount')->willReturn($mockAmount);
        $mockCharge->method('getCustomer')->willReturn($mockCustomer);
        $resource = new StripeChargeCreateEvent($mockCharge);

        $this::assertSame($mockCharge, $resource->getLocalCharge());
    }

    public function testAbstractStripeChargeEventRequiresAnAmount()
    {
        $mockCustomer = $this->createMock(StripeLocalCustomer::class);
        $mockCharge   = $this->createMock(StripeLocalCharge::class);
        $mockCharge->method('getCustomer')->willReturn($mockCustomer);

        $this::expectException(\InvalidArgumentException::class);
        new StripeChargeCreateEvent($mockCharge);
    }

    public function testAbstractStripeChargeEventRequiresACustomerOrACard()
    {
        $mockAmount = $this-- > $this->createMock(Money::class);
        $mockCharge = $this->createMock(StripeLocalCharge::class);
        $mockCharge->method('getAmount')->willReturn($mockAmount);

        $this::expectException(\InvalidArgumentException::class);
        new StripeChargeCreateEvent($mockCharge);
    }
}
