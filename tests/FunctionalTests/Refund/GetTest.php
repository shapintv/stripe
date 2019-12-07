<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests\FunctionalTests\Refund;

use Shapin\Stripe\Model\MetadataCollection;
use Shapin\Stripe\Model\Refund\Refund;
use Shapin\Stripe\Tests\FunctionalTests\TestCase;

final class GetTest extends TestCase
{
    private $refundApi;

    public function setUp(): void
    {
        $this->refundApi = $this->getStripeClient()->refunds();
    }

    public function testGet()
    {
        $refund = $this->refundApi->get('re_1DP4yDIpafQncvOMVW1hj2Vb');

        $this->assertInstanceOf(Refund::class, $refund);

        $this->assertSame('100', $refund->getAmount()->getAmount());
        $this->assertNull($refund->getBalanceTransaction());
        $this->assertIsString($refund->getCharge());
        $this->assertSame(1234567890, $refund->getCreatedAt()->getTimestamp());
        $this->assertSame('USD', (string) $refund->getCurrency());
        $this->assertNull($refund->getFailureBalanceTransaction());
        $this->assertNull($refund->getFailureReason());
        $this->assertInstanceOf(MetadataCollection::class, $refund->getMetadata());
        $this->assertCount(0, $refund->getMetadata());
        $this->assertNull($refund->getReason());
        $this->assertNull($refund->getReceiptNumber());
        $this->assertNull($refund->getSourceTransferReversal());
        $this->assertSame('succeeded', $refund->getStatus());
    }
}
