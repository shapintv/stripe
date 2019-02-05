<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests;

use PHPUnit\Framework\TestCase;
use Shapin\Stripe\EventBuilder;
use Shapin\Stripe\Exception\InvalidArgumentException;

final class EventBuilderTest extends TestCase
{
    public function supportedEvents()
    {
        yield ['account.external_account.created', Event\AccountExternalAccountCreatedEvent::class];
        yield ['account.external_account.deleted', Event\AccountExternalAccountDeletedEvent::class];
        yield ['account.external_account.updated', Event\AccountExternalAccountUpdatedEvent::class];
        yield ['account.updated', Event\AccountUpdatedEvent::class];
        yield ['charge.captured', Event\ChargeCapturedEvent::class];
        yield ['charge.failed', Event\ChargeFailedEvent::class];
        yield ['charge.refunded', Event\ChargeRefundedEvent::class];
        yield ['charge.succeeded', Event\ChargeSucceededEvent::class];
        yield ['customer.source.created', Event\CustomerSourceCreated::class];
        yield ['customer.subscription.created', Event\CustomerSubscriptionCreatedEvent::class];
    }

    public function unsupportedEvents()
    {
        yield ['account.application.authorized'];
        yield ['account.application.deauthorized'];
    }

    /**
     * @dataProvider supportedEvents
     */
    public function testSupportedEvents(string $eventName, string $expectedEventClass)
    {
        $data = json_decode(file_get_contents(__DIR__."/fixtures/events/$eventName.json"), true);

        $this->assertSame($eventName, $data['type']);

        $event = (new EventBuilder())->createEventFromArray($data);
        $this->assertSame($eventName, $event->getType());
    }

    /**
     * @dataProvider unsupportedEvents
     */
    public function testUnsupportedEvents(string $eventName)
    {
        $data = json_decode(file_get_contents(__DIR__."/fixtures/events/$eventName.json"), true);

        $this->assertSame($eventName, $data['type']);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Unable to process event: Event \"$eventName\" is not supported yet.");

        (new EventBuilder())->createEventFromArray($data);
    }
}
