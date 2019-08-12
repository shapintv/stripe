<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests\FunctionalTests\SetupIntent;

use Shapin\Stripe\Model\SetupIntent\SetupIntent;
use Shapin\Stripe\Model\MetadataCollection;
use Shapin\Stripe\Tests\FunctionalTests\TestCase;

final class GetTest extends TestCase
{
    private $setupIntentApi;

    public function setUp(): void
    {
        $this->setupIntentApi = $this->getStripeClient()->setupIntents();
    }

    public function testGet()
    {
        $setupIntent = $this->setupIntentApi->get('seti_123456789');

        $this->assertInstanceOf(SetupIntent::class, $setupIntent);

        $this->assertSame('seti_123456789', $setupIntent->getId());
        $this->assertNull($setupIntent->getApplicationId());
        $this->assertNull($setupIntent->getCancellationReason());
        $this->assertNull($setupIntent->getClientSecret());
        $this->assertSame(1234567890, $setupIntent->getCreatedAt()->getTimestamp());
        $this->assertNull($setupIntent->getCustomerId());
        $this->assertNull($setupIntent->getDescription());
        $this->assertNull($setupIntent->getLastSetupError());
        $this->assertNull($setupIntent->getNextAction());
        $this->assertNull($setupIntent->getOnBehalfOfId());
        $this->assertNull($setupIntent->getPaymentMethodId());
        $this->assertSame(['card'], $setupIntent->getPaymentMethodTypes());
        $this->assertSame(SetupIntent::STATUS_REQUIRES_PAYMENT_METHOD, $setupIntent->getStatus());
        $this->assertSame(SetupIntent::USAGE_OFF_SESSION, $setupIntent->getUsage());
        $this->assertFalse($setupIntent->isLive());
        $this->assertInstanceOf(MetadataCollection::class, $setupIntent->getMetadata());
        $this->assertCount(1, $setupIntent->getMetadata());
    }
}
