<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests\FunctionalTests\Balance;

use Shapin\Stripe\Model\Balance\Balance;
use Shapin\Stripe\Tests\FunctionalTests\TestCase;

final class GetTest extends TestCase
{
    private $balanceApi;

    public function setUp(): void
    {
        $this->balanceApi = $this->getStripeClient()->balances();
    }

    public function testGet()
    {
        $balance = $this->balanceApi->get();

        $this->assertInstanceOf(Balance::class, $balance);

        $this->assertFalse($balance->isLive());

        $this->assertCount(0, $balance->getAvailable());
        $this->assertCount(0, $balance->getConnectReserved());
        $this->assertCount(0, $balance->getPending());
    }
}
