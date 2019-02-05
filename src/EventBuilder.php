<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe;

use Shapin\Stripe\Exception\InvalidArgumentException;
use Shapin\Stripe\Model\Event;

final class EventBuilder
{
    public function createEventFromArray(array $data): Event\Event
    {
        if (!isset($data['type'])) {
            throw new InvalidArgumentException('Unable to process event: No "type" provided in array.');
        }

        switch ($data['type']) {
            case 'account.external_account.created':
                return Event\AccountExternalAccountCreatedEvent::createFromArray($data);
            case 'account.external_account.deleted':
                return Event\AccountExternalAccountDeletedEvent::createFromArray($data);
            case 'account.external_account.updated':
                return Event\AccountExternalAccountUpdatedEvent::createFromArray($data);
            case 'account.updated':
                return Event\AccountUpdatedEvent::createFromArray($data);
            case 'charge.captured':
                return Event\ChargeCapturedEvent::createFromArray($data);
            case 'charge.failed':
                return Event\ChargeFailedEvent::createFromArray($data);
            case 'charge.refunded':
                return Event\ChargeRefundedEvent::createFromArray($data);
            case 'charge.succeeded':
                return Event\ChargeSucceededEvent::createFromArray($data);
            case 'customer.source.created':
                return Event\CustomerSourceCreatedEvent::createFromArray($data);
            case 'customer.subscription.created':
                return Event\CustomerSubscriptionCreatedEvent::createFromArray($data);
            default:
                throw new InvalidArgumentException("Unable to process event: Event \"{$data['type']}\" is not supported yet.");
        }
    }
}
