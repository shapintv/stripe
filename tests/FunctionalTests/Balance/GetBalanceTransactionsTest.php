<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests\FunctionalTests\Balance;

use Shapin\Stripe\Model\Balance\BalanceTransaction;
use Shapin\Stripe\Model\Balance\BalanceTransactionCollection;
use Shapin\Stripe\Tests\FunctionalTests\TestCase;

final class GetBalanceTransactionsTest extends TestCase
{
    private $balanceApi;

    public function setUp(): void
    {
        $this->balanceApi = $this->getStripeClient()->balances();
    }

    public function testGetBalanceTransaction()
    {
        $balanceTransactionCollection = $this->balanceApi->getBalanceTransactions();

        $this->assertInstanceOf(BalanceTransactionCollection::class, $balanceTransactionCollection);
        $this->assertCount(1, $balanceTransactionCollection);
        $this->assertFalse($balanceTransactionCollection->hasMore());

        foreach ($balanceTransactionCollection as $balanceTransaction) {
            $this->assertInstanceOf(BalanceTransaction::class, $balanceTransaction);
        }
    }
}
