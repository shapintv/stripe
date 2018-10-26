<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests\Api\BankAccount;

use Shapin\Stripe\Model\BankAccount\BankAccount;
use Shapin\Stripe\Model\MetadataCollection;
use Shapin\Stripe\Tests\FunctionalTests\TestCase;;

final class GetTest extends TestCase
{
    private $bankAccountApi;

    public function setUp()
    {
        $this->bankAccountApi = $this->getStripeClient()->bankAccounts();
    }

    public function testGet()
    {
        $bankAccount = $this->bankAccountApi->get('cus_DqnsnSXuILi5XU', 'ba_1DP6GIIpafQncvOME10D5Nft');

        $this->assertInstanceOf(BankAccount::class, $bankAccount);

        $this->assertSame('ba_1DP6GIIpafQncvOME10D5Nft', $bankAccount->getId());
        $this->assertNull($bankAccount->getAccount());
        $this->assertSame('Jane Austen', $bankAccount->getAccountHolderName());
        $this->assertSame('individual', $bankAccount->getAccountHolderType());
        $this->assertSame('STRIPE TEST BANK', $bankAccount->getBankName());
        $this->assertSame('US', $bankAccount->getCountry());
        $this->assertSame('USD', (string) $bankAccount->getCurrency());
        $this->assertNull($bankAccount->getCustomer());
        $this->assertSame('qry29YhF51GlzDtE', $bankAccount->getFingerprint());
        $this->assertSame('6789', $bankAccount->getLastFour());
        $this->assertInstanceOf(MetadataCollection::class, $bankAccount->getMetadata());
        $this->assertCount(0, $bankAccount->getMetadata());
        $this->assertSame('110000000', $bankAccount->getRoutingNumber());
        $this->assertSame('new', $bankAccount->getStatus());
    }
}
