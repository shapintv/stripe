<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests\FunctionalTests\Coupon;

use Shapin\Stripe\Model\Coupon\Coupon;
use Shapin\Stripe\Tests\FunctionalTests\TestCase;

final class CreateTest extends TestCase
{
    private $couponApi;

    public function setUp(): void
    {
        $this->couponApi = $this->getStripeClient()->coupons();
    }

    public function testCreateCoupon()
    {
        $coupon = $this->couponApi->create([
            'duration' => 'once',
            'amount_off' => 500,
            'currency' => 'EUR',
            'name' => 'a test coupon',
        ]);

        $this->assertInstanceOf(Coupon::class, $coupon);
    }
}
