<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Subscription;

use Shapin\Stripe\Model\ContainsMetadata;
use Shapin\Stripe\Model\CreatableFromArray;
use Shapin\Stripe\Model\Discount\Discount;
use Shapin\Stripe\Model\LivemodeTrait;
use Shapin\Stripe\Model\MetadataCollection;
use Shapin\Stripe\Model\MetadataTrait;
use Shapin\Stripe\Model\Plan\Plan;

final class Subscription implements CreatableFromArray, ContainsMetadata
{
    use LivemodeTrait;
    use MetadataTrait;

    const BILLING_CHARGE_AUTOMATICALLY = 'charge_automatically';
    const BILLING_SEND_INVOICE = 'send_invoice';

    const STATUS_EXPIRED = 'incomplete_expired';
    const STATUS_INCOMPLETE = 'incomplete';
    const STATUS_TRIALING = 'trialing';
    const STATUS_ACTIVE = 'active';
    const STATUS_PAST_DUE = 'past_due';
    const STATUS_CANCELED = 'canceled';
    const STATUS_UNPAID = 'unpaid';

    /**
     * @var string
     */
    private $id;

    /**
     * @var ?float
     */
    private $applicationFeePercent;

    /**
     * @var string
     */
    private $collectionMethod;

    /**
     * @var mixed
     */
    private $billingCycleAnchor;

    /**
     * @var bool
     */
    private $cancelAtPeriodEnd;

    /**
     * @var ?\DateTimeImmutable
     */
    private $canceledAt;

    /**
     * @var \DateTimeImmutable
     */
    private $createdAt;

    /**
     * @var \DateTimeImmutable
     */
    private $currentPeriodEndAt;

    /**
     * @var \DateTimeImmutable
     */
    private $currentPeriodStartAt;

    /**
     * @var string
     */
    private $customer;

    /**
     * @var ?int
     */
    private $daysUntilDue;

    /**
     * @var ?string
     */
    private $defaultSource;

    /**
     * @var array
     */
    private $defaultTaxRates;

    /**
     * @var ?Discount
     */
    private $discount;

    /**
     * @var ?\DateTimeImmutable
     */
    private $endedAt;

    /**
     * @var ItemCollection
     */
    private $items;

    /**
     * @var ?string
     */
    private $latestInvoiceId;

    /**
     * @var ?string
     */
    private $pendingSetupIntentId;

    /**
     * @var Plan
     */
    private $plan;

    /**
     * @var int
     */
    private $quantity;

    /**
     * @var \DateTimeImmutable
     */
    private $startAt;

    /**
     * @var string
     */
    private $status;

    /**
     * @var ?\DateTimeImmutable
     */
    private $trialEndAt;

    /**
     * @var ?\DateTimeImmutable
     */
    private $trialStartAt;

    public static function createFromArray(array $data): self
    {
        $model = new self();
        $model->id = $data['id'];
        $model->applicationFeePercent = null !== $data['application_fee_percent'] ? (float) $data['application_fee_percent'] : null;
        $model->collectionMethod = $data['collection_method'];
        $model->billingCycleAnchor = $data['billing_cycle_anchor'];
        $model->cancelAtPeriodEnd = (bool) $data['cancel_at_period_end'];
        $model->canceledAt = null !== $data['canceled_at'] ? new \DateTimeImmutable('@'.$data['canceled_at']) : null;
        $model->createdAt = new \DateTimeImmutable('@'.$data['created']);
        $model->currentPeriodEndAt = new \DateTimeImmutable('@'.$data['current_period_end']);
        $model->currentPeriodStartAt = new \DateTimeImmutable('@'.$data['current_period_start']);
        $model->customer = $data['customer'];
        $model->daysUntilDue = null !== $data['days_until_due'] ? (int) $data['days_until_due'] : null;
        $model->defaultSource = $data['default_source'] ?? null;
        $model->defaultTaxRates = $data['default_tax_rates'];
        $model->discount = isset($data['discount']) ? Discount::createFromArray($data['discount']) : null;
        $model->endedAt = null !== $data['ended_at'] ? new \DateTimeImmutable('@'.$data['ended_at']) : null;
        $model->items = ItemCollection::createFromArray($data['items']);
        $model->latestInvoiceId = $data['latest_invoice'];
        $model->live = $data['livemode'];
        $model->metadata = MetadataCollection::createFromArray($data['metadata']);
        $model->pendingSetupIntentId = $data['pending_setup_intent'] ?? null;
        $model->plan = Plan::createFromArray($data['plan']);
        $model->quantity = (int) $data['quantity'];
        $model->startAt = new \DateTimeImmutable('@'.$data['start_date']);
        $model->status = $data['status'];
        $model->trialEndAt = null !== $data['trial_end'] ? new \DateTimeImmutable('@'.$data['trial_end']) : null;
        $model->trialStartAt = null !== $data['trial_start'] ? new \DateTimeImmutable('@'.$data['trial_start']) : null;

        return $model;
    }

    public function isBilledAutomatically(): bool
    {
        return self::BILLING_CHARGE_AUTOMATICALLY === $this->collectionMethod;
    }

    public function isIncomplete(): bool
    {
        return self::STATUS_INCOMPLETE === $this->status;
    }

    public function isExpired(): bool
    {
        return self::STATUS_EXPIRED === $this->status;
    }

    public function isTrialing(): bool
    {
        return self::STATUS_TRIALING === $this->status;
    }

    public function isActive(): bool
    {
        return self::STATUS_ACTIVE === $this->status;
    }

    public function isPastDue(): bool
    {
        return self::STATUS_PAST_DUE === $this->status;
    }

    public function isCanceled(): bool
    {
        return self::STATUS_CANCELED === $this->status;
    }

    public function isUnpaid(): bool
    {
        return self::STATUS_UNPAID === $this->status;
    }

    public function hasDefaultSource(): bool
    {
        return null !== $this->defaultSource;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getApplicationFeePercent(): ?float
    {
        return $this->applicationFeePercent;
    }

    public function getBilling(): string
    {
        @trigger_error('Calling the method getBilling is deprecated since Stripe API 2019-10-17. Use getCollectionMethod instead.', E_USER_DEPRECATED);

        return $this->collectionMethod;
    }

    public function getCollectionMethod(): string
    {
        return $this->collectionMethod;
    }

    public function getBillingCycleAnchor()
    {
        return $this->billingCycleAnchor;
    }

    public function willBeCanceledAtPeriodEnd(): bool
    {
        return $this->cancelAtPeriodEnd;
    }

    public function getCanceledAt(): ?\DateTimeImmutable
    {
        return $this->canceledAt;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getCurrentPeriodEndAt(): \DateTimeImmutable
    {
        return $this->currentPeriodEndAt;
    }

    public function getCurrentPeriodStartAt(): \DateTimeImmutable
    {
        return $this->currentPeriodStartAt;
    }

    public function getCustomer(): string
    {
        return $this->customer;
    }

    public function getDaysUntilDue(): ?int
    {
        return $this->daysUntilDue;
    }

    public function getDefaultSource(): ?string
    {
        return $this->defaultSource;
    }

    public function getDefaultTaxRates(): array
    {
        return $this->defaultTaxRates;
    }

    public function getDiscount(): ?Discount
    {
        return $this->discount;
    }

    public function hasDiscount(): bool
    {
        return null !== $this->discount;
    }

    public function hasActiveDiscountForCurrentPeriod(): bool
    {
        if (!$this->hasDiscount()) {
            return false;
        }

        // Discount start after the current period
        if ($this->getCurrentPeriodEndAt() < $this->discount->getStartAt()) {
            return false;
        }

        // Discount has ended before the current period
        $endAt = $this->discount->getEndAt() ?? $this->discount->getStartAt();
        if ($this->getCurrentPeriodStartAt() > $endAt) {
            return false;
        }

        return true;
    }

    public function getEndedAt(): ?\DateTimeImmutable
    {
        return $this->endedAt;
    }

    public function getItems(): ItemCollection
    {
        return $this->items;
    }

    public function getLatestInvoiceId(): ?string
    {
        return $this->latestInvoiceId;
    }

    public function getPendingSetupIntentId(): ?string
    {
        return $this->pendingSetupIntentId;
    }

    public function getPlan(): Plan
    {
        return $this->plan;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getStartAt(): \DateTimeImmutable
    {
        return $this->startAt;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getTrialEndAt(): ?\DateTimeImmutable
    {
        return $this->trialEndAt;
    }

    public function getTrialStartAt(): ?\DateTimeImmutable
    {
        return $this->trialStartAt;
    }
}
