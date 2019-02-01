<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Plan;

use Shapin\Stripe\Model\ContainsMetadata;
use Shapin\Stripe\Model\CreatableFromArray;
use Shapin\Stripe\Model\LivemodeTrait;
use Shapin\Stripe\Model\MetadataTrait;
use Shapin\Stripe\Model\MetadataCollection;
use Money\Currency;
use Money\Money;

final class Plan implements CreatableFromArray, ContainsMetadata
{
    use LivemodeTrait, MetadataTrait;

    const AGGREGATE_USAGE_SUM = 'sum';
    const AGGREGATE_USAGE_LAST_DURING_PERIOD = 'last_during_period';
    const AGGREGATE_USAGE_LAST_EVER = 'last_ever';
    const AGGREGATE_USAGE_MAX = 'max';

    const BILLING_SCHEME_PER_UNIT = 'per_unit';
    const BILLING_SCHEME_TIERED = 'tiered';

    const INTERVAL_DAY = 'day';
    const INTERVAL_WEEK = 'week';
    const INTERVAL_MONTH = 'month';
    const INTERVAL_YEAR = 'year';

    const TIERS_MODE_GRADUATED = 'graduated';
    const TIERS_MODE_VOLUME = 'volume';

    const USAGE_TYPE_METERED = 'metered';
    const USAGE_TYPE_LICENSED = 'licensed';

    const ROUND_DOWN = 'down';
    const ROUND_UP = 'up';

    /**
     * @var string
     */
    private $id;

    /**
     * @var bool
     */
    private $active;

    /**
     * @var ?string
     */
    private $aggregateUsage;

    /**
     * @var Money
     */
    private $amount;

    /**
     * @var string
     */
    private $billingScheme;

    /**
     * @var \DateTimeImmutable
     */
    private $createdAt;

    /**
     * @var Currency
     */
    private $currency;

    /**
     * @var string
     */
    private $interval;

    /**
     * @var int
     */
    private $intervalCount;

    /**
     * @var ?string
     */
    private $nickname;

    /**
     * @var string
     */
    private $product;

    /**
     * @var array
     */
    private $tiers;

    /**
     * @var ?string
     */
    private $tiersMode;

    /**
     * @var ?TransformUsage
     */
    private $transformUsage;

    /**
     * @var ?int
     */
    private $trialPeriodDays;

    /**
     * @var string
     */
    private $usageType;

    public static function createFromArray(array $data): self
    {
        $currency = new Currency(strtoupper($data['currency']));

        $tiers = [];
        if (isset($data['tiers'])) {
            foreach ($data['tiers'] as $tier) {
                $tiers[] = Tier::createFromArray($tier);
            }
        }

        $model = new self();
        $model->id = $data['id'];
        $model->active = (bool) $data['active'];
        $model->aggregateUsage = $data['aggregate_usage'];
        $model->amount = new Money($data['amount'], $currency);
        $model->billingScheme = $data['billing_scheme'];
        $model->createdAt = new \DateTimeImmutable('@'.$data['created']);
        $model->currency = $currency;
        $model->interval = $data['interval'];
        $model->intervalCount = (int) $data['interval_count'];
        $model->live = $data['livemode'];
        $model->metadata = MetadataCollection::createFromArray($data['metadata']);
        $model->nickname = $data['nickname'];
        $model->product = $data['product'];
        $model->tiers = $tiers;
        $model->tiersMode = $data['tiers_mode'];
        $model->transformUsage = isset($data['transform_usage']) ? TransformUsage::createFromArray($data['transform_usage']) : null;
        $model->trialPeriodDays = $data['trial_period_days'];
        $model->usageType = $data['usage_type'];

        return $model;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function getAgregateUsage(): ?string
    {
        return $this->aggregateUsage;
    }

    public function getAmount(): Money
    {
        return $this->amount;
    }

    public function getBilingScheme(): string
    {
        return $this->billingScheme;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    public function getInterval(): string
    {
        return $this->interval;
    }

    public function getIntervalCount(): int
    {
        return $this->intervalCount;
    }

    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    public function getProduct(): string
    {
        return $this->product;
    }

    public function getTiers(): array
    {
        return $this->tiers;
    }

    public function getTiersMode(): ?string
    {
        return $this->tiersMode;
    }

    public function getTransformUsage(): ?TransformUsage
    {
        return $this->transformUsage;
    }

    public function getTrialPeriodDays(): ?int
    {
        return $this->trialPeriodDays;
    }

    public function getUsageType(): string
    {
        return $this->usageType;
    }
}
