<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests\FunctionalTests\Coupon;

use Shapin\Stripe\Model\Coupon\Coupon;
use Shapin\Stripe\Model\MetadataCollection;
use Shapin\Stripe\Tests\FunctionalTests\TestCase;

final class GetTest extends TestCase
{
    private $couponApi;

    public function setUp(): void
    {
        $this->couponApi = $this->getStripeClient()->coupons();
    }

    public function testGet()
    {
        $coupon = $this->couponApi->get('25_5OFF');

        $this->assertInstanceOf(Coupon::class, $coupon);

        $this->assertSame('25_5OFF', $coupon->getId());
        $this->assertNull($coupon->getAmountOff());
        $this->assertSame(1234567890, $coupon->getCreatedAt()->getTimestamp());
        $this->assertNull($coupon->getCurrency());
        $this->assertSame(Coupon::DURATION_REPEATING, $coupon->getDuration());
        $this->assertSame(3, $coupon->getDurationInMonths());
        $this->assertFalse($coupon->isLive());
        $this->assertNull($coupon->getMaxRedemptions());
        $this->assertInstanceOf(MetadataCollection::class, $coupon->getMetadata());
        $this->assertCount(0, $coupon->getMetadata());
        $this->assertSame('25.5% off', $coupon->getName());
        $this->assertSame(1234567890, $coupon->getRedeemBy()->getTimestamp());
        $this->assertSame(0, $coupon->getTimesRedeemed());
        $this->assertTrue($coupon->isValid());
    }
}
