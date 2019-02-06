<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe;

use Shapin\Stripe\Exception\InvalidArgumentException;
use Shapin\Stripe\Model\Event;
use Symfony\Component\HttpFoundation\Request;

final class EventBuilder
{
    public function createEventFromRequest(Request $request): Event\Event
    {
        $data = json_decode($request->getContent(), true);

        if (\JSON_ERROR_NONE !== json_last_error()) {
            throw new InvalidArgumentException('Unable to process Request: Invalid JSON provided ('.json_last_error_msg().')');
        }

        return $this->createEventFromArray($data);
    }

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
            case 'balance.available':
                return Event\BalanceAvailableEvent::createFromArray($data);
            case 'charge.captured':
                return Event\ChargeCapturedEvent::createFromArray($data);
            case 'charge.expired':
                return Event\ChargeExpiredEvent::createFromArray($data);
            case 'charge.failed':
                return Event\ChargeFailedEvent::createFromArray($data);
            case 'charge.pending':
                return Event\ChargePendingEvent::createFromArray($data);
            case 'charge.refund.updated':
                return Event\ChargeRefundUpdatedEvent::createFromArray($data);
            case 'charge.refunded':
                return Event\ChargeRefundedEvent::createFromArray($data);
            case 'charge.succeeded':
                return Event\ChargeSucceededEvent::createFromArray($data);
            case 'customer.bank_account.deleted':
                return Event\CustomerBankAccountDeletedEvent::createFromArray($data);
            case 'customer.created':
                return Event\CustomerCreatedEvent::createFromArray($data);
            case 'customer.deleted':
                return Event\CustomerDeletedEvent::createFromArray($data);
            case 'customer.source.created':
                return Event\CustomerSourceCreatedEvent::createFromArray($data);
            case 'customer.source.deleted':
                return Event\CustomerSourceDeletedEvent::createFromArray($data);
            case 'customer.source.expiring':
                return Event\CustomerSourceExpiringEvent::createFromArray($data);
            case 'customer.source.updated':
                return Event\CustomerSourceUpdatedEvent::createFromArray($data);
            case 'customer.subscription.created':
                return Event\CustomerSubscriptionCreatedEvent::createFromArray($data);
            case 'customer.subscription.deleted':
                return Event\CustomerSubscriptionDeletedEvent::createFromArray($data);
            case 'customer.subscription.trial_will_end':
                return Event\CustomerSubscriptionTrialWillEndEvent::createFromArray($data);
            case 'customer.subscription.updated':
                return Event\CustomerSubscriptionUpdatedEvent::createFromArray($data);
            case 'customer.updated':
                return Event\CustomerUpdatedEvent::createFromArray($data);
            case 'plan.created':
                return Event\PlanCreatedEvent::createFromArray($data);
            case 'plan.deleted':
                return Event\PlanDeletedEvent::createFromArray($data);
            case 'plan.updated':
                return Event\PlanUpdatedEvent::createFromArray($data);
            case 'product.created':
                return Event\ProductCreatedEvent::createFromArray($data);
            case 'product.deleted':
                return Event\ProductDeletedEvent::createFromArray($data);
            case 'product.updated':
                return Event\ProductUpdatedEvent::createFromArray($data);
            case 'source.canceled':
                return Event\SourceCanceledEvent::createFromArray($data);
            case 'source.chargeable':
                return Event\SourceChargeableEvent::createFromArray($data);
            case 'source.failed':
                return Event\SourceFailedEvent::createFromArray($data);
            case 'source.mandate_notification':
                return Event\SourceMandateNotificationEvent::createFromArray($data);
            case 'source.refund_attributes_required':
                return Event\SourceRefundAttributesRequiredEvent::createFromArray($data);
            case 'transfer.created':
                return Event\TransferCreatedEvent::createFromArray($data);
            case 'transfer.reversed':
                return Event\TransferReversedEvent::createFromArray($data);
            case 'transfer.updated':
                return Event\TransferUpdatedEvent::createFromArray($data);

            default:
                throw new InvalidArgumentException("Unable to process event: Event \"{$data['type']}\" is not supported yet.");
        }
    }
}
