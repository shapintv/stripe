<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace FAPI\Stripe\Tests\Api\Balance;

use FAPI\Stripe\Model\Balance\Balance;
use FAPI\Stripe\Model\Balance\BalancePart;
use FAPI\Stripe\HttpClientConfigurator;
use FAPI\Stripe\Tests\Api\ApiTestCase;;
use Http\Client\Common\Plugin\HeaderAppendPlugin;
use Money\Money;

final class GetTest extends ApiTestCase
{
    private $balanceApi;

    public function setUp()
    {
        $this->balanceApi = $this->getStripeClient()->balances();
    }

    public function testGet()
    {
        $balance = $this->balanceApi->get();

        $this->assertInstanceOf(Balance::class, $balance);

        $this->assertFalse($balance->isLive());

        $this->assertCount(1, $balance->getAvailable());
        $this->assertInstanceOf(BalancePart::class, $balance->getAvailable()[0]);
        $this->assertInstanceOf(Money::class, $balance->getAvailable()[0]->getAmount());
        $this->assertSame('0', $balance->getAvailable()[0]->getAmount()->getAmount());
        $this->assertSame('USD', (string) $balance->getAvailable()[0]->getAmount()->getCurrency());

        $this->assertCount(1, $balance->getConnectReserved());
        $this->assertInstanceOf(BalancePart::class, $balance->getConnectReserved()[0]);
        $this->assertInstanceOf(Money::class, $balance->getConnectReserved()[0]->getAmount());
        $this->assertSame('0', $balance->getConnectReserved()[0]->getAmount()->getAmount());
        $this->assertSame('USD', (string) $balance->getConnectReserved()[0]->getAmount()->getCurrency());

        $this->assertCount(1, $balance->getPending());
        $this->assertInstanceOf(BalancePart::class, $balance->getPending()[0]);
        $this->assertInstanceOf(Money::class, $balance->getPending()[0]->getAmount());
        $this->assertSame('0', $balance->getPending()[0]->getAmount()->getAmount());
        $this->assertSame('USD', (string) $balance->getPending()[0]->getAmount()->getCurrency());
    }
}
