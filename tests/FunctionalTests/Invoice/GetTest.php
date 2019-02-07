<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests\FunctionalTests\Invoice;

use Shapin\Stripe\Model\Invoice\LineItem;
use Shapin\Stripe\Model\Invoice\LineItemCollection;
use Shapin\Stripe\Model\Invoice\Invoice;
use Shapin\Stripe\Model\Invoice\Period;
use Shapin\Stripe\Model\MetadataCollection;
use Shapin\Stripe\Tests\FunctionalTests\TestCase;

final class GetTest extends TestCase
{
    private $invoiceApi;

    public function setUp()
    {
        $this->invoiceApi = $this->getStripeClient()->invoices();
    }

    public function testGet()
    {
        $invoice = $this->invoiceApi->get('in_1E09ubIpafQncvOMUhmgO0ph');

        $this->assertInstanceOf(Invoice::class, $invoice);

        $this->assertSame('in_1E09ubIpafQncvOMUhmgO0ph', $invoice->getId());
        $this->assertSame('0', $invoice->getAmountDue()->getAmount());
        $this->assertSame('0', $invoice->getAmountPaid()->getAmount());
        $this->assertSame('0', $invoice->getAmountRemaining()->getAmount());
        $this->assertNull($invoice->getApplicationFeeAmount());
        $this->assertSame(0, $invoice->getAttemptCount());
        $this->assertFalse($invoice->isAttempted());
        $this->assertTrue($invoice->isAutoAdvance());
        $this->assertSame(Invoice::BILLING_CHARGE_AUTOMATICALLY, $invoice->getBilling());
        $this->assertSame(Invoice::BILLING_REASON_MANUAL, $invoice->getBillingReason());
        $this->assertNull($invoice->getCharge());
        $this->assertSame(1234567890, $invoice->getCreatedAt()->getTimestamp());
        $this->assertSame('USD', (string) $invoice->getCurrency());
        $this->assertSame([], $invoice->getCustomFields());
        $this->assertSame('cus_Dpl4sEDRQnKTh3', $invoice->getCustomer());
        $this->assertNull($invoice->getDefaultSource());
        $this->assertNull($invoice->getDescription());
        $this->assertNull($invoice->getDiscount());
        $this->assertNull($invoice->getDueAt());
        $this->assertNull($invoice->getEndingBalance());
        $this->assertNull($invoice->getFinalizedAt());
        $this->assertNull($invoice->getFooter());
        $this->assertNull($invoice->getHostedInvoiceUrl());
        $this->assertNull($invoice->getInvoicePdf());

        $this->assertInstanceOf(LineItemCollection::class, $invoice->getLines());
        $this->assertCount(1, $invoice->getLines());
        $line = $invoice->getLines()[0];
        $this->assertSame('ii_1DPFJDFgK3s3qfch3dxGckGD', $line->getId());
        $this->assertSame('1000', $line->getAmount()->getAmount());
        $this->assertSame('USD', (string) $line->getCurrency());
        $this->assertSame('My First Invoice Item (created for API docs)', $line->getDescription());
        $this->assertTrue($line->isDiscountable());
        $this->assertNull($line->getHydraId());
        $this->assertSame('ii_1DPFJDFgK3s3qfch3dxGckGD', $line->getInvoiceItem());
        $this->assertInstanceOf(Period::class, $line->getPeriod());
        $this->assertSame(1540498799, $line->getPeriod()->getEndAt()->getTimestamp());
        $this->assertSame(1540498799, $line->getPeriod()->getStartAt()->getTimestamp());
        $this->assertNull($line->getPlan());
        $this->assertFalse($line->isProration());
        $this->assertSame(1, $line->getQuantity());
        $this->assertNull($line->getSubscription());
        $this->assertNull($line->getSubscriptionItem());
        $this->assertSame(LineItem::TYPE_INVOICE_ITEM, $line->getType());
        $this->assertFalse($line->isLive());
        $this->assertInstanceOf(MetadataCollection::class, $invoice->getMetadata());
        $this->assertCount(0, $invoice->getMetadata());

        $this->assertSame(1234567890, $invoice->getNextPaymentAttempt()->getTimestamp());
        $this->assertSame('FADD2E8-0001', $invoice->getNumber());
        $this->assertFalse($invoice->isPaid());
        $this->assertSame(1234567890, $invoice->getPeriodEndAt()->getTimestamp());
        $this->assertSame(1234567890, $invoice->getPeriodStartAt()->getTimestamp());
        $this->assertNull($invoice->getReceiptNumber());
        $this->assertSame('0', $invoice->getStartingBalance()->getAmount());
        $this->assertNull($invoice->getStatementDescriptor());
        $this->assertNull($invoice->getStatus());
        $this->assertNull($invoice->getSubscription());
        $this->assertNull($invoice->getSubscriptionProrationAt());
        $this->assertSame('0', $invoice->getSubtotal()->getAmount());
        $this->assertSame('0', $invoice->getTax()->getAmount());
        $this->assertSame((float) 0, $invoice->getTaxPercent());
        $this->assertSame('0', $invoice->getTotal()->getAmount());
        $this->assertNull($invoice->getThresholdReason());
        $this->assertSame(1234567890, $invoice->getWebhooksDeliveredAt()->getTimestamp());
        $this->assertFalse($invoice->isLive());
        $this->assertInstanceOf(MetadataCollection::class, $invoice->getMetadata());
        $this->assertCount(0, $invoice->getMetadata());
    }
}
