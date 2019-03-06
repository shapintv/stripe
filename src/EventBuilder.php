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
    private $events = [
        'account.external_account.created' => Event\AccountExternalAccountCreatedEvent::class,
        'account.external_account.deleted' => Event\AccountExternalAccountDeletedEvent::class,
        'account.external_account.updated' => Event\AccountExternalAccountUpdatedEvent::class,
        'account.updated' => Event\AccountUpdatedEvent::class,
        'balance.available' => Event\BalanceAvailableEvent::class,
        'charge.captured' => Event\ChargeCapturedEvent::class,
        'charge.expired' => Event\ChargeExpiredEvent::class,
        'charge.failed' => Event\ChargeFailedEvent::class,
        'charge.pending' => Event\ChargePendingEvent::class,
        'charge.refund.updated' => Event\ChargeRefundUpdatedEvent::class,
        'charge.refunded' => Event\ChargeRefundedEvent::class,
        'charge.succeeded' => Event\ChargeSucceededEvent::class,
        'coupon.created' => Event\CouponCreatedEvent::class,
        'coupon.deleted' => Event\CouponDeletedEvent::class,
        'coupon.updated' => Event\CouponUpdatedEvent::class,
        'customer.bank_account.deleted' => Event\CustomerBankAccountDeletedEvent::class,
        'customer.created' => Event\CustomerCreatedEvent::class,
        'customer.deleted' => Event\CustomerDeletedEvent::class,
        'customer.discount.created' => Event\CustomerDiscountCreatedEvent::class,
        'customer.discount.deleted' => Event\CustomerDiscountDeletedEvent::class,
        'customer.discount.updated' => Event\CustomerDiscountUpdatedEvent::class,
        'customer.source.created' => Event\CustomerSourceCreatedEvent::class,
        'customer.source.deleted' => Event\CustomerSourceDeletedEvent::class,
        'customer.source.expiring' => Event\CustomerSourceExpiringEvent::class,
        'customer.source.updated' => Event\CustomerSourceUpdatedEvent::class,
        'customer.subscription.created' => Event\CustomerSubscriptionCreatedEvent::class,
        'customer.subscription.deleted' => Event\CustomerSubscriptionDeletedEvent::class,
        'customer.subscription.trial_will_end' => Event\CustomerSubscriptionTrialWillEndEvent::class,
        'customer.subscription.updated' => Event\CustomerSubscriptionUpdatedEvent::class,
        'customer.updated' => Event\CustomerUpdatedEvent::class,
        'invoice.created' => Event\InvoiceCreatedEvent::class,
        'invoice.deleted' => Event\InvoiceDeletedEvent::class,
        'invoice.finalized' => Event\InvoiceFinalizedEvent::class,
        'invoice.marked_uncollectible' => Event\InvoiceMarkedUncollectibleEvent::class,
        'invoice.payment_failed' => Event\InvoicePaymentFailedEvent::class,
        'invoice.payment_succeeded' => Event\InvoicePaymentSucceededEvent::class,
        'invoice.sent' => Event\InvoiceSentEvent::class,
        'invoice.upcoming' => Event\InvoiceUpcomingEvent::class,
        'invoice.updated' => Event\InvoiceUpdatedEvent::class,
        'invoice.voided' => Event\InvoiceVoidedEvent::class,
        'invoiceitem.created' => Event\InvoiceItemCreatedEvent::class,
        'invoiceitem.deleted' => Event\InvoiceItemDeletedEvent::class,
        'invoiceitem.updated' => Event\InvoiceItemUpdatedEvent::class,
        'plan.created' => Event\PlanCreatedEvent::class,
        'plan.deleted' => Event\PlanDeletedEvent::class,
        'plan.updated' => Event\PlanUpdatedEvent::class,
        'product.created' => Event\ProductCreatedEvent::class,
        'product.deleted' => Event\ProductDeletedEvent::class,
        'product.updated' => Event\ProductUpdatedEvent::class,
        'source.canceled' => Event\SourceCanceledEvent::class,
        'source.chargeable' => Event\SourceChargeableEvent::class,
        'source.failed' => Event\SourceFailedEvent::class,
        'source.mandate_notification' => Event\SourceMandateNotificationEvent::class,
        'source.refund_attributes_required' => Event\SourceRefundAttributesRequiredEvent::class,
        'transfer.created' => Event\TransferCreatedEvent::class,
        'transfer.reversed' => Event\TransferReversedEvent::class,
        'transfer.updated' => Event\TransferUpdatedEvent::class,
    ];

    public function createEventFromRequest(Request $request): Event\Event
    {
        $data = json_decode((string) $request->getContent(), true);

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

        if (\array_key_exists($data['type'], $this->events)) {
            return \call_user_func($this->events[$data['type']].'::createFromArray', $data);
        }

        throw new InvalidArgumentException("Unable to process event: Event \"{$data['type']}\" is not supported yet.");
    }
}
