<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests\FunctionalTests\PaymentIntent;

use Shapin\Stripe\Model\PaymentIntent\PaymentIntent;
use Shapin\Stripe\Tests\FunctionalTests\TestCase;

final class CreateTest extends TestCase
{
    private $paymentIntentApi;

    public function setUp(): void
    {
        $this->paymentIntentApi = $this->getStripeClient()->paymentIntents();
    }

    public function testCreate()
    {
        $paymentIntent = $this->paymentIntentApi->create([
            'amount' => 1000,
            'currency' => 'EUR',
        ]);

        $this->assertInstanceOf(PaymentIntent::class, $paymentIntent);
    }
}
