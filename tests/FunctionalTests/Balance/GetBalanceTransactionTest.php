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

final class GetBalanceTransactionTest extends TestCase
{
    private $balanceApi;

    public function setUp()
    {
        $this->balanceApi = $this->getStripeClient()->balances();
    }

    public function testGetBalanceTransaction()
    {
        $id = 'txn_1DMF8jIpafQncvOM81SXEPbG';

        $balanceTransaction = $this->balanceApi->getBalanceTransaction($id);

        $this->assertInstanceOf(BalanceTransaction::class, $balanceTransaction);
        $this->assertSame($id, $balanceTransaction->getId());
        $this->assertInstanceOf(Money::class, $balanceTransaction->getAmount());
        $this->assertSame('100', $balanceTransaction->getAmount()->getAmount());
        $this->assertSame('USD', (string) $balanceTransaction->getAmount()->getCurrency());
        $this->assertInstanceOf(\DateTimeImmutable::class, $balanceTransaction->getAvailableOn());
        $this->assertSame('My First Test Charge (created for API docs)', $balanceTransaction->getDescription());
        $this->assertNull($balanceTransaction->getExchangeRate());
        $this->assertInstanceOf(Money::class, $balanceTransaction->getFee());
        $this->assertSame('0', $balanceTransaction->getFee()->getAmount());
        $this->assertSame('USD', (string) $balanceTransaction->getFee()->getCurrency());
        $this->assertCount(0, $balanceTransaction->getFeeDetails());
        $this->assertSame('ch_1DO5YeFgK3s3qfchfs8alIMx', $balanceTransaction->getSource());
        $this->assertSame('available', $balanceTransaction->getStatus());
        $this->assertSame('charge', $balanceTransaction->getType());
        $this->assertInstanceOf(\DateTimeImmutable::class, $balanceTransaction->getCreatedAt());
    }
}
