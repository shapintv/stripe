<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests\FunctionalTests\Customer;

use Shapin\Stripe\Model\Account\Account;
use Shapin\Stripe\Model\Customer\Customer;
use Shapin\Stripe\Model\MetadataCollection;
use Shapin\Stripe\Model\Refund\Refund;
use Shapin\Stripe\Model\Refund\RefundCollection;
use Shapin\Stripe\Tests\FunctionalTests\TestCase;

final class GetTest extends TestCase
{
    private $customerApi;

    public function setUp()
    {
        $this->customerApi = $this->getStripeClient()->customers();
    }

    public function testGet()
    {
        $customer = $this->customerApi->get('cus_ERVlaeXFbkOLgD');

        $this->assertInstanceOf(Customer::class, $customer);

        $this->assertSame('cus_ERVlaeXFbkOLgD', $customer->getId());
        $this->assertSame(0, $customer->getAccountBalance());
        $this->assertSame(1234567890, $customer->getCreatedAt()->getTimestamp());
        $this->assertSame('USD', (string) $customer->getCurrency());
        $this->assertNull($customer->getDefaultSource());
        $this->assertFalse($customer->isDelinquent());
        $this->assertNull($customer->getDescription());
        $this->assertNull($customer->getDiscount());
        $this->assertNull($customer->getEmail());
        $this->assertSame('FADD2E8', $customer->getInvoicePrefix());
        $this->assertNull($customer->getInvoiceSettings());
        $this->assertCount(0, $customer->getSources());
        //$this->assertCount(0, $customer->getSubscriptions());
        $this->assertNull($customer->getTaxInfo());
        $this->assertNull($customer->getTaxInfoVerification());
        $this->assertFalse($customer->isLive());
    }
}