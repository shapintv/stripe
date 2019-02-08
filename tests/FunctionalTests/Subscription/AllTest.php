<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests\FunctionalTests\Subscription;

use Shapin\Stripe\Model\Subscription\Subscription;
use Shapin\Stripe\Model\Subscription\SubscriptionCollection;
use Shapin\Stripe\Tests\FunctionalTests\TestCase;

final class AllTest extends TestCase
{
    private $subscriptionApi;

    public function setUp(): void
    {
        $this->subscriptionApi = $this->getStripeClient()->subscriptions();
    }

    public function testGetSubscription()
    {
        $subscriptionCollection = $this->subscriptionApi->all();

        $this->assertInstanceOf(SubscriptionCollection::class, $subscriptionCollection);
        $this->assertCount(1, $subscriptionCollection);
        $this->assertFalse($subscriptionCollection->hasMore());

        foreach ($subscriptionCollection as $subscription) {
            $this->assertInstanceOf(Subscription::class, $subscription);
        }
    }
}
