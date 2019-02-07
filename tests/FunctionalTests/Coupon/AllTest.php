<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests\FunctionalTests\Coupon;

use Shapin\Stripe\Model\Coupon\Coupon;
use Shapin\Stripe\Model\Coupon\CouponCollection;
use Shapin\Stripe\Tests\FunctionalTests\TestCase;

final class AllTest extends TestCase
{
    private $couponApi;

    public function setUp()
    {
        $this->couponApi = $this->getStripeClient()->coupons();
    }

    public function testGetCoupon()
    {
        $couponCollection = $this->couponApi->all();

        $this->assertInstanceOf(CouponCollection::class, $couponCollection);
        $this->assertCount(1, $couponCollection);
        $this->assertFalse($couponCollection->hasMore());

        foreach ($couponCollection as $coupon) {
            $this->assertInstanceOf(Coupon::class, $coupon);
        }
    }
}
