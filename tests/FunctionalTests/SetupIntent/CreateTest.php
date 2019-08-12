<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests\FunctionalTests\SetupIntent;

use Shapin\Stripe\Model\Charge\ChargeCollection;
use Shapin\Stripe\Model\SetupIntent\SetupIntent;
use Shapin\Stripe\Model\MetadataCollection;
use Shapin\Stripe\Tests\FunctionalTests\TestCase;

final class CreateTest extends TestCase
{
    private $setupIntentApi;

    public function setUp(): void
    {
        $this->setupIntentApi = $this->getStripeClient()->setupIntents();
    }

    public function testCreate()
    {
        $setupIntent = $this->setupIntentApi->create([]);

        $this->assertInstanceOf(SetupIntent::class, $setupIntent);
    }
}
