<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests\FunctionalTests\Refund;

use Shapin\Stripe\Model\Refund\Refund;
use Shapin\Stripe\Model\Refund\RefundCollection;
use Shapin\Stripe\Tests\FunctionalTests\TestCase;

final class AllTest extends TestCase
{
    private $refundApi;

    public function setUp()
    {
        $this->refundApi = $this->getStripeClient()->refunds();
    }

    public function testGetRefund()
    {
        $refundCollection = $this->refundApi->all();

        $this->assertInstanceOf(RefundCollection::class, $refundCollection);
        $this->assertCount(1, $refundCollection);
        $this->assertFalse($refundCollection->hasMore());

        foreach ($refundCollection as $refund) {
            $this->assertInstanceOf(Refund::class, $refund);
        }
    }
}
