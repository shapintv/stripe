<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests\FunctionalTests\Customer;

use Shapin\Stripe\Model\Customer\CustomerDeleted;
use Shapin\Stripe\Tests\FunctionalTests\TestCase;

final class DeleteTest extends TestCase
{
    private $customerApi;

    public function setUp(): void
    {
        $this->customerApi = $this->getStripeClient()->customers();
    }

    public function testGet()
    {
        $customerDeleted = $this->customerApi->delete('cus_ERVlaeXFbkOLgD');

        $this->assertInstanceOf(CustomerDeleted::class, $customerDeleted);
        $this->assertSame('cus_ERVlaeXFbkOLgD', $customerDeleted->getId());
        $this->assertTrue($customerDeleted->isDeleted());
    }
}
