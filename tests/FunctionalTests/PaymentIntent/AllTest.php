<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests\FunctionalTests\PaymentIntent;

use Shapin\Stripe\Model\PaymentIntent\PaymentIntent;
use Shapin\Stripe\Model\PaymentIntent\PaymentIntentCollection;
use Shapin\Stripe\Tests\FunctionalTests\TestCase;

final class AllTest extends TestCase
{
    private $paymentIntentApi;

    public function setUp(): void
    {
        $this->paymentIntentApi = $this->getStripeClient()->paymentIntents();
    }

    public function testGetPaymentIntent()
    {
        $paymentIntentCollection = $this->paymentIntentApi->all();

        $this->assertInstanceOf(PaymentIntentCollection::class, $paymentIntentCollection);
        $this->assertCount(1, $paymentIntentCollection);
        $this->assertFalse($paymentIntentCollection->hasMore());

        foreach ($paymentIntentCollection as $paymentIntent) {
            $this->assertInstanceOf(PaymentIntent::class, $paymentIntent);
        }
    }
}
