<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests\FunctionalTests\Customer;

use Shapin\Stripe\Model\Customer\Customer;
use Shapin\Stripe\Model\Customer\CustomerCollection;
use Shapin\Stripe\Tests\FunctionalTests\TestCase;

final class AllTest extends TestCase
{
    private $customerApi;

    public function setUp(): void
    {
        $this->customerApi = $this->getStripeClient()->customers();
    }

    public function testGetCustomer()
    {
        $customerCollection = $this->customerApi->all();

        $this->assertInstanceOf(CustomerCollection::class, $customerCollection);
        $this->assertCount(1, $customerCollection);
        $this->assertFalse($customerCollection->hasMore());

        foreach ($customerCollection as $customer) {
            $this->assertInstanceOf(Customer::class, $customer);
        }
    }
}
