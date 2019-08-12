<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests\FunctionalTests\SetupIntent;

use Shapin\Stripe\Model\SetupIntent\SetupIntent;
use Shapin\Stripe\Model\SetupIntent\SetupIntentCollection;
use Shapin\Stripe\Tests\FunctionalTests\TestCase;

final class AllTest extends TestCase
{
    private $setupIntentApi;

    public function setUp(): void
    {
        $this->setupIntentApi = $this->getStripeClient()->setupIntents();
    }

    public function testGetSetupIntent()
    {
        $setupIntentCollection = $this->setupIntentApi->all();

        $this->assertInstanceOf(SetupIntentCollection::class, $setupIntentCollection);
        $this->assertCount(1, $setupIntentCollection);
        $this->assertFalse($setupIntentCollection->hasMore());

        foreach ($setupIntentCollection as $setupIntent) {
            $this->assertInstanceOf(SetupIntent::class, $setupIntent);
        }
    }
}
