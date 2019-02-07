<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Invoice;

use Shapin\Stripe\Model\ContainsMetadata;
use Shapin\Stripe\Model\CreatableFromArray;
use Shapin\Stripe\Model\Customer\CustomField;
use Shapin\Stripe\Model\LivemodeTrait;
use Shapin\Stripe\Model\MetadataTrait;
use Shapin\Stripe\Model\MetadataCollection;
use Money\Currency;
use Money\Money;

final class Invoice implements CreatableFromArray, ContainsMetadata
{
    use LivemodeTrait, MetadataTrait;

    const BILLING_CHARGE_AUTOMATICALLY = 'charge_automatically';
    const BILLING_SEND_INVOICE = 'send_invoice';

    const BILLING_REASON_SUBSCRIPTION_CYCLE = 'subscription_cycle';
    const BILLING_REASON_SUBSCRIPTION_CREATE = 'subscription_create';
    const BILLING_REASON_SUBSCRIPTION_UPDATE = 'subscription_update';
    const BILLING_REASON_SUBSCRIPTION = 'subscription';
    const BILLING_REASON_MANUAL = 'manual';
    const BILLING_REASON_UPCOMING = 'upcoming';
    const BILLING_REASON_SUBSCRIPTION_THRESHOLD = 'subscription_threshold';

    const STATUS_DRAFT = 'draft';
    const STATUS_OPEN = 'open';
    const STATUS_PAID = 'paid';
    const STATUS_UNCOLLECTIBLE = 'uncollectible';
    const STATUS_VOID = 'void';

    /**
     * @var string
     */
    private $id;

    /**
     * @var Money
     */
    private $amountDue;

    /**
     * @var Money
     */
    private $amountPaid;

    /**
     * @var Money
     */
    private $amountRemaining;

    /**
     * @var ?Money
     */
    private $applicationFeeAmount;

    /**
     * @var int
     */
    private $attemptCount;

    /**
     * @var bool
     */
    private $attempted;

    /**
     * @var bool
     */
    private $autoAdvance;

    /**
     * @var string
     */
    private $billing;

    /**
     * @var string
     */
    private $billingReason;

    /**
     * @var ?string
     */
    private $charge;

    /**
     * @var \DateTimeImmutable
     */
    private $createdAt;

    /**
     * @var string
     */
    private $currency;

    /**
     * @var array
     */
    private $customFields;

    /**
     * @var string
     */
    private $customer;

    /**
     * @var ?string
     */
    private $defaultSource;

    /**
     * @var string
     */
    private $description;

    /**
     * @var ?Discount
     */
    private $discount;

    /**
     * @var ?\DateTimeImmutable
     */
    private $dueAt;

    /**
     * @var ?Money
     */
    private $endingBalance;

    /**
     * @var ?\DateTimeImmutable
     */
    private $finalizedAt;

    /**
     * @var ?string
     */
    private $footer;

    /**
     * @var ?string
     */
    private $hostedInvoiceUrl;

    /**
     * @var ?string
     */
    private $invoicePdf;

    /**
     * @var LineItemCollection
     */
    private $lines;

    /**
     * @var ?\DateTimeImmutable
     */
    private $nextPaymentAttempt;

    /**
     * @var string
     */
    private $number;

    /**
     * @var bool
     */
    private $paid;

    /**
     * @var ?\DateTimeImmutable
     */
    private $periodEndAt;

    /**
     * @var ?\DateTimeImmutable
     */
    private $periodStartAt;

    /**
     * @var ?string
     */
    private $receiptNumber;

    /**
     * @var Money
     */
    private $startingBalance;

    /**
     * @var ?string
     */
    private $statementDescriptor;

    /**
     * @var ?string
     */
    private $status;

    /**
     * @var string
     */
    private $subscription;

    /**
     * @var ?\DateTimeImmutable
     */
    private $subscriptionProrationAt;

    /**
     * @var int
     */
    private $subtotal;

    /**
     * @var Money
     */
    private $tax;

    /**
     * @var float
     */
    private $taxPercent;

    /**
     * @var ?ThresholdReason
     */
    private $thresholdReason;

    /**
     * @var Money
     */
    private $total;

    /**
     * @var \DateTimeImmutable
     */
    private $webhookDeliveredAt;

    public static function createFromArray(array $data): self
    {
        $currency = new Currency(strtoupper($data['currency']));

        $customFields = [];
        if (isset($data['custom_fields'])) {
            foreach ($data['custom_fields'] as $customField) {
                $customFields[] = new CustomField($customField['name'], $customField['value']);
            }
        }

        $model = new self();
        $model->id = $data['id'];
        $model->amountDue = new Money($data['amount_due'], $currency);
        $model->amountPaid = new Money($data['amount_paid'], $currency);
        $model->amountRemaining = new Money($data['amount_remaining'], $currency);
        $model->applicationFeeAmount = isset($data['application_fee_amount']) ? new Money($data['application_fee_amount'], $currency) : null;
        $model->attemptCount = (int) $data['attempt_count'];
        $model->attempted = (bool) $data['attempted'];
        $model->autoAdvance = (bool) $data['auto_advance'];
        $model->billing = $data['billing'];
        $model->billingReason = $data['billing_reason'];
        $model->charge = $data['charge'];
        $model->createdAt = new \DateTimeImmutable('@'.$data['date']);
        $model->currency = $currency;
        $model->customFields = $customFields;
        $model->customer = $data['customer'];
        $model->defaultSource = $data['default_source'] ?? null;
        $model->description = $data['description'];
        $model->discount = isset($data['discount']) ? Discount::createFromArray($data['discount']) : null;
        $model->dueAt = isset($data['due_at']) ? new \DateTimeImmutable('@'.$data['due_at']) : null;
        $model->endingBalance = isset($data['ending_balance']) ? new Money($data['ending_balance'], $currency) : null;
        $model->finalizedAt = isset($data['finalized_at']) ? new \DateTimeImmutable('@'.$data['finalized_at']) : null;
        $model->footer = $data['footer'] ?? null;
        $model->hostedInvoiceUrl = $data['hosted_invoice_url'];
        $model->invoicePdf = $data['invoice_pdf'];
        $model->lines = LineItemCollection::createFromArray($data['lines']);
        $model->live = $data['livemode'];
        $model->metadata = MetadataCollection::createFromArray($data['metadata']);
        $model->nextPaymentAttempt = isset($data['next_payment_attempt']) ? new \DateTimeImmutable('@'.$data['next_payment_attempt']) : null;
        $model->number = $data['number'];
        $model->paid = (bool) $data['paid'];
        $model->periodEndAt = new \DateTimeImmutable('@'.$data['period_end']);
        $model->periodStartAt = new \DateTimeImmutable('@'.$data['period_start']);
        $model->receiptNumber = $data['receipt_number'];
        $model->startingBalance = new Money($data['starting_balance'], $currency);
        $model->statementDescriptor = $data['statement_descriptor'];
        $model->status = $data['status'] ?? null;
        $model->subscription = $data['subscription'];
        $model->subscriptionProrationAt = isset($data['subscription_proration_at']) ? new \DateTimeImmutable('@'.$data['subscription_proration_at']) : null;
        $model->subtotal = new Money($data['subtotal'], $currency);
        $model->tax = new Money($data['tax'], $currency);
        $model->taxPercent = (float) $data['tax_percent'];
        $model->thresholdReason = isset($data['threshold_reason']) ? ThresholdReason::createFromArray($data['threshold_reason']) : null;
        $model->total = new Money($data['total'], $currency);
        $model->webhooksDeliveredAt = new \DateTimeImmutable('@'.$data['webhooks_delivered_at']);

        return $model;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getAmountDue(): Money
    {
        return $this->amountDue;
    }

    public function getAmountPaid(): Money
    {
        return $this->amountPaid;
    }

    public function getAmountRemaining(): Money
    {
        return $this->amountRemaining;
    }

    public function getApplicationFeeAmount(): ?Money
    {
        return $this->applicationFeeAmount;
    }

    public function getAttemptCount(): int
    {
        return $this->attemptCount;
    }

    public function isAttempted(): bool
    {
        return $this->attempted;
    }

    public function isAutoAdvance(): bool
    {
        return $this->autoAdvance;
    }

    public function getBilling(): string
    {
        return $this->billing;
    }

    public function getBillingReason(): string
    {
        return $this->billingReason;
    }

    public function getCharge(): ?string
    {
        return $this->charge;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    public function getCustomFields(): array
    {
        return $this->customFields;
    }

    public function getCustomer(): string
    {
        return $this->customer;
    }

    public function getDefaultSource(): ?string
    {
        return $this->defaultSource;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getDiscount(): ?Discount
    {
        return $this->discount;
    }

    public function getDueAt(): ?\DateTimeImmutable
    {
        return $this->dueAt;
    }

    public function getEndingBalance(): ?Money
    {
        return $this->endingBalance;
    }

    public function getFinalizedAt(): ?\DateTimeImmutable
    {
        return $this->finalizedAt;
    }

    public function getFooter(): ?string
    {
        return $this->footer;
    }

    public function getHostedInvoiceUrl(): ?string
    {
        return $this->hostedInvoiceUrl;
    }

    public function getInvoicePdf(): ?string
    {
        return $this->invoicePdf;
    }

    public function getLines(): LineItemCollection
    {
        return $this->lines;
    }

    public function getNextPaymentAttempt(): ?\DateTimeImmutable
    {
        return $this->nextPaymentAttempt;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function isPaid(): bool
    {
        return $this->paid;
    }

    public function getPeriodEndAt(): \DateTimeImmutable
    {
        return $this->periodEndAt;
    }

    public function getPeriodStartAt(): \DateTimeImmutable
    {
        return $this->periodStartAt;
    }

    public function getReceiptNumber(): ?string
    {
        return $this->receiptNumber;
    }

    public function getStartingBalance(): Money
    {
        return $this->startingBalance;
    }

    public function getStatementDescriptor(): ?string
    {
        return $this->statementDescriptor;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function getSubscription(): ?string
    {
        return $this->subscription;
    }

    public function getSubscriptionProrationAt(): ?\DateTimeImmutable
    {
        return $this->subscriptionProrationAt;
    }

    public function getSubtotal(): Money
    {
        return $this->subtotal;
    }

    public function getTax(): Money
    {
        return $this->tax;
    }

    public function getTaxPercent(): float
    {
        return $this->taxPercent;
    }

    public function getThresholdReason(): ?ThresholdReason
    {
        return $this->thresholdReason;
    }

    public function getTotal(): Money
    {
        return $this->total;
    }

    public function getWebhooksDeliveredAt(): \DateTimeImmutable
    {
        return $this->webhooksDeliveredAt;
    }
}
