<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests\FunctionalTests\Account;

use Shapin\Stripe\Model\Account\Account;
use Shapin\Stripe\Model\Account\AccountCollection;
use Shapin\Stripe\Tests\FunctionalTests\TestCase;

final class AllTest extends TestCase
{
    private $accountApi;

    public function setUp(): void
    {
        $this->accountApi = $this->getStripeClient()->accounts();
    }

    public function testGetAccount()
    {
        $accountCollection = $this->accountApi->all();

        $this->assertInstanceOf(AccountCollection::class, $accountCollection);
        $this->assertCount(1, $accountCollection);
        $this->assertFalse($accountCollection->hasMore());

        foreach ($accountCollection as $account) {
            $this->assertInstanceOf(Account::class, $account);
        }
    }
}
