<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace FAPI\Stripe\Tests\Api\Balance;

use FAPI\Stripe\Model\Balance\Balance;
use FAPI\Stripe\Model\Balance\BalancePart;
use FAPI\Stripe\Model\Balance\BalanceTransaction;
use FAPI\Stripe\Model\Balance\BalanceTransactionCollection;
use FAPI\Stripe\Model\Balance\FeeDetails;
use FAPI\Stripe\HttpClientConfigurator;
use FAPI\Stripe\Tests\FunctionalTests\TestCase;;
use Http\Client\Common\Plugin\HeaderAppendPlugin;
use Money\Money;

final class GetBalanceTransactionsTest extends TestCase
{
    private $balanceApi;

    public function setUp()
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
