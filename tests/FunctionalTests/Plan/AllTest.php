<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests\FunctionalTests\Plan;

use Shapin\Stripe\Model\Plan\Plan;
use Shapin\Stripe\Model\Plan\PlanCollection;
use Shapin\Stripe\Tests\FunctionalTests\TestCase;

final class AllTest extends TestCase
{
    private $planApi;

    public function setUp(): void
    {
        $this->planApi = $this->getStripeClient()->plans();
    }

    public function testGetPlan()
    {
        $planCollection = $this->planApi->all();

        $this->assertInstanceOf(PlanCollection::class, $planCollection);
        $this->assertCount(1, $planCollection);
        $this->assertFalse($planCollection->hasMore());

        foreach ($planCollection as $plan) {
            $this->assertInstanceOf(Plan::class, $plan);
        }
    }
}
