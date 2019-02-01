<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests\FunctionalTests\Subscription;

use Shapin\Stripe\Model\Subscription\ItemCollection;
use Shapin\Stripe\Model\Subscription\Subscription;
use Shapin\Stripe\Model\MetadataCollection;
use Shapin\Stripe\Tests\FunctionalTests\TestCase;

final class GetTest extends TestCase
{
    private $subscriptionApi;

    public function setUp()
    {
        $this->subscriptionApi = $this->getStripeClient()->subscriptions();
    }

    public function testGet()
    {
        $subscription = $this->subscriptionApi->get('sub_ERVlqYNDDX0sZR');

        $this->assertInstanceOf(Subscription::class, $subscription);

        $this->assertSame('sub_ERVlqYNDDX0sZR', $subscription->getId());
        $this->assertNull($subscription->getApplicationFeePercent());
        $this->assertSame(Subscription::BILLING_CHARGE_AUTOMATICALLY, $subscription->getBilling());
        $this->assertTrue($subscription->isBilledAutomatically());
        $this->assertSame(1234567890, $subscription->getBillingCycleAnchor());
        $this->assertFalse($subscription->willBeCanceledAtPeriodEnd());
        $this->assertSame(1234567890, $subscription->getCanceledAt()->getTimestamp());
        $this->assertSame(1234567890, $subscription->getCreatedAt()->getTimestamp());
        $this->assertSame(1234567890, $subscription->getCurrentPeriodEndAt()->getTimestamp());
        $this->assertSame(1234567890, $subscription->getCurrentPeriodStartAt()->getTimestamp());
        $this->assertSame('cus_Dpl4sEDRQnKTh3', $subscription->getCustomer());
        $this->assertNull($subscription->getDaysUntilDue());
        $this->assertNull($subscription->getDefaultSource());
        $this->assertSame(1234567890, $subscription->getEndedAt()->getTimestamp());
        $this->assertInstanceOf(ItemCollection::class, $subscription->getItems());
        $this->assertCount(1, $subscription->getItems());
        $this->assertFalse($subscription->isLive());
        $this->assertInstanceOf(MetadataCollection::class, $subscription->getMetadata());
        $this->assertCount(0, $subscription->getMetadata());
        $this->assertSame(1, $subscription->getQuantity());
        $this->assertSame(1234567890, $subscription->getStartAt()->getTimestamp());
        $this->assertSame(Subscription::STATUS_ACTIVE, $subscription->getStatus());
        $this->assertNull($subscription->getTaxPercent());
        $this->assertSame(1234567890, $subscription->getTrialEndAt()->getTimestamp());
        $this->assertSame(1234567890, $subscription->getTrialStartAt()->getTimestamp());
    }
}
