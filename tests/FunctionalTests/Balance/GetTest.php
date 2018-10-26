<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests\Api\Balance;

use Shapin\Stripe\Model\Balance\Balance;
use Shapin\Stripe\Model\Balance\BalancePart;
use Shapin\Stripe\Model\Balance\BalanceTransaction;
use Shapin\Stripe\Model\Balance\FeeDetails;
use Shapin\Stripe\HttpClientConfigurator;
use Shapin\Stripe\Tests\FunctionalTests\TestCase;;
use Http\Client\Common\Plugin\HeaderAppendPlugin;
use Money\Money;

final class GetTest extends TestCase
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

        $this->assertCount(0, $balance->getAvailable());
        $this->assertCount(0, $balance->getConnectReserved());
        $this->assertCount(0, $balance->getPending());
    }
}
