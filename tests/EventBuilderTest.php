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
use Shapin\Stripe\Model\Event;
use Symfony\Component\HttpFoundation\Request;

final class EventBuilderTest extends TestCase
{
    public function testValidRequest()
    {
        $request = new Request([], [], [], [], [], [], file_get_contents(__DIR__.'/fixtures/events/charge.captured.json'));

        $event = (new EventBuilder())->createEventFromRequest($request);
        $this->assertSame('charge.captured', $event->getType());
    }

    public function testInvalidRequest()
    {
        $request = new Request([], [], [], [], [], [], '{invalidjson');

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Unable to process Request: Invalid JSON provided (Syntax error)');

        (new EventBuilder())->createEventFromRequest($request);
    }

    public function supportedEvents()
    {
        yield ['account.external_account.created', Event\AccountExternalAccountCreatedEvent::class];
        yield ['account.external_account.deleted', Event\AccountExternalAccountDeletedEvent::class];
        yield ['account.external_account.updated', Event\AccountExternalAccountUpdatedEvent::class];
        yield ['account.updated', Event\AccountUpdatedEvent::class];
        yield ['balance.available', Event\BalanceAvailableEvent::class];
        yield ['charge.captured', Event\ChargeCapturedEvent::class];
        yield ['charge.expired', Event\ChargeExpiredEvent::class];
        yield ['charge.failed', Event\ChargeFailedEvent::class];
        yield ['charge.pending', Event\ChargePendingEvent::class];
        yield ['charge.refund.updated', Event\ChargeRefundUpdatedEvent::class];
        yield ['charge.refunded', Event\ChargeRefundedEvent::class];
        yield ['charge.succeeded', Event\ChargeSucceededEvent::class];
        yield ['coupon.created', Event\CouponCreatedEvent::class];
        yield ['coupon.deleted', Event\CouponDeletedEvent::class];
        yield ['coupon.updated', Event\CouponUpdatedEvent::class];
        yield ['customer.bank_account.deleted', Event\CustomerBankAccountDeletedEvent::class];
        yield ['customer.created', Event\CustomerCreatedEvent::class];
        yield ['customer.deleted', Event\CustomerDeletedEvent::class];
        yield ['customer.discount.created', Event\CustomerDiscountCreatedEvent::class];
        yield ['customer.discount.deleted', Event\CustomerDiscountDeletedEvent::class];
        yield ['customer.discount.updated', Event\CustomerDiscountUpdatedEvent::class];
        yield ['customer.source.created', Event\CustomerSourceCreatedEvent::class];
        yield ['customer.source.deleted', Event\CustomerSourceDeletedEvent::class];
        yield ['customer.source.expiring', Event\CustomerSourceExpiringEvent::class];
        yield ['customer.source.updated', Event\CustomerSourceUpdatedEvent::class];
        yield ['customer.subscription.created', Event\CustomerSubscriptionCreatedEvent::class];
        yield ['customer.subscription.deleted', Event\CustomerSubscriptionDeletedEvent::class];
        yield ['customer.subscription.trial_will_end', Event\CustomerSubscriptionTrialWillEndEvent::class];
        yield ['customer.subscription.updated', Event\CustomerSubscriptionUpdatedEvent::class];
        yield ['customer.updated', Event\CustomerUpdatedEvent::class];
        yield ['invoice.created', Event\InvoiceCreatedEvent::class];
        yield ['invoice.deleted', Event\InvoiceDeletedEvent::class];
        yield ['invoice.finalized', Event\InvoiceFinalizedEvent::class];
        yield ['invoice.payment_failed', Event\InvoicePaymentFailedEvent::class];
        yield ['invoice.payment_succeeded', Event\InvoicePaymentSucceededEvent::class];
        yield ['invoice.sent', Event\InvoiceSentEvent::class];
        yield ['invoice.upcoming', Event\InvoiceUpcomingEvent::class];
        yield ['invoice.updated', Event\InvoiceUpdatedEvent::class];
        yield ['invoice.voided', Event\InvoiceVoidedEvent::class];
        yield ['invoiceitem.created', Event\InvoiceItemCreatedEvent::class];
        yield ['invoiceitem.deleted', Event\InvoiceItemDeletedEvent::class];
        yield ['invoiceitem.updated', Event\InvoiceItemUpdatedEvent::class];
        yield ['plan.created', Event\PlanCreatedEvent::class];
        yield ['plan.deleted', Event\PlanDeletedEvent::class];
        yield ['plan.updated', Event\PlanUpdatedEvent::class];
        yield ['product.created', Event\ProductCreatedEvent::class];
        yield ['product.deleted', Event\ProductDeletedEvent::class];
        yield ['product.updated', Event\ProductUpdatedEvent::class];
        yield ['source.canceled', Event\SourceCanceledEvent::class];
        yield ['source.chargeable', Event\SourceChargeableEvent::class];
        yield ['source.failed', Event\SourceFailedEvent::class];
        yield ['source.mandate_notification', Event\SourceMandateNotificationEvent::class];
        yield ['source.refund_attributes_required', Event\SourceRefundAttributesRequiredEvent::class];
        yield ['transfer.created', Event\TransferCreatedEvent::class];
        yield ['transfer.reversed', Event\TransferReversedEvent::class];
        yield ['transfer.updated', Event\TransferUpdatedEvent::class];
    }

    public function unsupportedEvents()
    {
        yield ['account.application.authorized'];
        yield ['account.application.deauthorized'];
        yield ['application_fee.created'];
        yield ['application_fee.refund.updated'];
        yield ['application_fee.refunded'];
        yield ['charge.dispute.closed'];
        yield ['charge.dispute.created'];
        yield ['charge.dispute.funds_reinstated'];
        yield ['charge.dispute.funds_withdrawn'];
        yield ['checkout_beta.session_succeeded'];
        yield ['file.created'];
        yield ['issuing_authorization.created'];
        yield ['issuing_authorization.request'];
        yield ['issuing_authorization.updated'];
        yield ['issuing_card.created'];
        yield ['issuing_card.updated'];
        yield ['issuing_cardholder.created'];
        yield ['issuing_cardholder.updated'];
        yield ['issuing_dispute.created'];
        yield ['issuing_dispute.updated'];
        yield ['issuing_settlement.created'];
        yield ['issuing_settlement.updated'];
        yield ['issuing_transaction.created'];
        yield ['issuing_transaction.updated'];
        yield ['order.created'];
        yield ['order.payment_failed'];
        yield ['order.payment_succeeded'];
        yield ['order.updated'];
        yield ['order_return.created'];
        yield ['payment_intent.amount_capturable_updated'];
        yield ['payment_intent.created'];
        yield ['payment_intent.payment_failed'];
        yield ['payment_intent.requires_capture'];
        yield ['payment_intent.succeeded'];
        yield ['payout.canceled'];
        yield ['payout.created'];
        yield ['payout.failed'];
        yield ['payout.paid'];
        yield ['payout.updated'];
        yield ['recipient.created'];
        yield ['recipient.deleted'];
        yield ['recipient.updated'];
        yield ['reporting.report_run.failed'];
        yield ['reporting.report_run.succeeded'];
        yield ['reporting.report_type.updated'];
        yield ['review.closed'];
        yield ['review.opened'];
        yield ['sigma.scheduled_query_run.created'];
        yield ['sku.created'];
        yield ['sku.deleted'];
        yield ['sku.updated'];
        yield ['source.transaction.created'];
        yield ['source.transaction.updated'];
        yield ['topup.canceled'];
        yield ['topup.created'];
        yield ['topup.failed'];
        yield ['topup.reversed'];
        yield ['topup.succeeded'];
    }

    /**
     * @dataProvider supportedEvents
     */
    public function testSupportedEvents(string $eventName, string $expectedEventClass)
    {
        $data = json_decode(file_get_contents(__DIR__."/fixtures/events/$eventName.json"), true);
        $this->assertSame(\JSON_ERROR_NONE, json_last_error());

        $this->assertSame($eventName, $data['type']);

        $event = (new EventBuilder())->createEventFromArray($data);
        $this->assertSame($eventName, $event->getType());
    }

    public function testInvoiceMarkedAsUncollectibleEvent()
    {
        $data = json_decode(file_get_contents(__DIR__.'/fixtures/events/invoice.marked_uncollectible.json'), true);
        $this->assertSame(\JSON_ERROR_NONE, json_last_error());

        $this->assertSame('invoice.payment_action_required', $data['type']);

        $event = (new EventBuilder())->createEventFromArray($data);
        $this->assertSame('invoice.payment_action_required', $event->getType());
    }

    public function testCustomerCardCreatedEvent()
    {
        $data = json_decode(file_get_contents(__DIR__.'/fixtures/events/customer.card.created.json'), true);
        $this->assertSame(\JSON_ERROR_NONE, json_last_error());

        $this->assertSame('customer.source.created', $data['type']);

        $event = (new EventBuilder())->createEventFromArray($data);
        $this->assertSame('customer.source.created', $event->getType());
    }

    /**
     * @dataProvider unsupportedEvents
     */
    public function testUnsupportedEvents(string $eventName)
    {
        $data = json_decode(file_get_contents(__DIR__."/fixtures/events/$eventName.json"), true);
        $this->assertSame(\JSON_ERROR_NONE, json_last_error());

        $this->assertSame($eventName, $data['type'], 'No type found in json');

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Unable to process event: Event \"$eventName\" is not supported yet.");

        (new EventBuilder())->createEventFromArray($data);
    }
}
