<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests\FunctionalTests\Plan;

use Shapin\Stripe\Model\Plan\Plan;
use Shapin\Stripe\Model\MetadataCollection;
use Shapin\Stripe\Tests\FunctionalTests\TestCase;

final class GetTest extends TestCase
{
    private $planApi;

    public function setUp(): void
    {
        $this->planApi = $this->getStripeClient()->plans();
    }

    public function testGet()
    {
        $plan = $this->planApi->get('my_plan');

        $this->assertInstanceOf(Plan::class, $plan);

        $this->assertSame('my_plan', $plan->getId());
        $this->assertTrue($plan->isActive());
        $this->assertNull($plan->getAgregateUsage());
        $this->assertSame('2000', $plan->getAmount()->getAmount());
        $this->assertSame(Plan::BILLING_SCHEME_PER_UNIT, $plan->getBilingScheme());
        $this->assertSame(1234567890, $plan->getCreatedAt()->getTimestamp());
        $this->assertSame('USD', (string) $plan->getCurrency());
        $this->assertSame('month', (string) $plan->getInterval());
        $this->assertSame(1, $plan->getIntervalCount());
        $this->assertFalse($plan->isLive());
        $this->assertInstanceOf(MetadataCollection::class, $plan->getMetadata());
        $this->assertCount(0, $plan->getMetadata());
        $this->assertNull($plan->getNickname());
        $this->assertIsString($plan->getProduct());
        $this->assertSame([], $plan->getTiers());
        $this->assertNull($plan->getTiersMode());
        $this->assertNull($plan->getTransformUsage());
        $this->assertNull($plan->getTrialPeriodDays());
        $this->assertSame('licensed', $plan->getUsageType());
    }
}
