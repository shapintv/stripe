<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Subscription;

use Shapin\Stripe\Model\ContainsMetadata;
use Shapin\Stripe\Model\CreatableFromArray;
use Shapin\Stripe\Model\LivemodeTrait;
use Shapin\Stripe\Model\MetadataTrait;
use Shapin\Stripe\Model\MetadataCollection;
use Shapin\Stripe\Model\Plan\Plan;

final class Subscription implements CreatableFromArray, ContainsMetadata
{
    use LivemodeTrait, MetadataTrait;

    const BILLING_CHARGE_AUTOMATICALLY = 'charge_automatically';
    const BILLING_SEND_INVOICE = 'send_invoice';

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
    private $billing;

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
     * @var ?\DateTimeImmutable
     */
    private $endedAt;

    /**
     * @var ItemCollection
     */
    private $items;

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
     * @var ?float
     */
    private $taxPercent;

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
        $model->billing = $data['billing'];
        $model->billingCycleAnchor = $data['billing_cycle_anchor'];
        $model->cancelAtPeriodEnd = (bool) $data['cancel_at_period_end'];
        $model->canceledAt = null !== $data['canceled_at'] ? new \DateTimeImmutable('@'.$data['canceled_at']) : null;
        $model->createdAt = new \DateTimeImmutable('@'.$data['created']);
        $model->currentPeriodEndAt = new \DateTimeImmutable('@'.$data['current_period_end']);
        $model->currentPeriodStartAt = new \DateTimeImmutable('@'.$data['current_period_start']);
        $model->customer = $data['customer'];
        $model->daysUntilDue = null !== $data['days_until_due'] ? (int) $data['days_until_due'] : null;
        $model->defaultSource = $data['default_source'] ?? null;
        $model->endedAt = null !== $data['ended_at'] ? new \DateTimeImmutable('@'.$data['ended_at']) : null;
        $model->items = ItemCollection::createFromArray($data['items']);
        $model->live = $data['livemode'];
        $model->metadata = MetadataCollection::createFromArray($data['metadata']);
        $model->plan = Plan::createFromArray($data['plan']);
        $model->quantity = (int) $data['quantity'];
        $model->startAt = new \DateTimeImmutable('@'.$data['start']);
        $model->status = $data['status'];
        $model->taxPercent = null !== $data['tax_percent'] ? (float) $data['tax_percent'] : null;
        $model->trialEndAt = null !== $data['trial_end'] ? new \DateTimeImmutable('@'.$data['trial_end']) : null;
        $model->trialStartAt = null !== $data['trial_start'] ? new \DateTimeImmutable('@'.$data['trial_start']) : null;

        return $model;
    }

    public function isBilledAutomatically(): bool
    {
        return self::BILLING_CHARGE_AUTOMATICALLY === $this->billing;
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
        return $this->billing;
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

    public function getEndedAt(): ?\DateTimeImmutable
    {
        return $this->endedAt;
    }

    public function getItems(): ItemCollection
    {
        return $this->items;
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

    public function getTaxPercent(): ?float
    {
        return $this->taxPercent;
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
