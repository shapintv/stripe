<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests\FunctionalTests\Subscription;

use Shapin\Stripe\Model\Subscription\Item;
use Shapin\Stripe\Tests\FunctionalTests\TestCase;

final class GetItemTest extends TestCase
{
    private $subscriptionApi;

    public function setUp(): void
    {
        $this->subscriptionApi = $this->getStripeClient()->subscriptions();
    }

    public function testGet()
    {
        $item = $this->subscriptionApi->getItem('si_ERVlvIQFPNbvRq');

        $this->assertInstanceOf(Item::class, $item);

        $this->assertSame('si_ERVlvIQFPNbvRq', $item->getId());
        $this->assertInstanceOf(\DateTimeImmutable::class, $item->getCreatedAt());
        $this->assertCount(0, $item->getMetadata());
        $this->assertSame(1, $item->getQuantity());
        $this->assertIsString($item->getSubscription());
    }
}
