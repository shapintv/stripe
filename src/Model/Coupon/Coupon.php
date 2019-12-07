<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Coupon;

use Money\Currency;
use Money\Money;
use Shapin\Stripe\Model\ContainsMetadata;
use Shapin\Stripe\Model\CreatableFromArray;
use Shapin\Stripe\Model\LivemodeTrait;
use Shapin\Stripe\Model\MetadataCollection;
use Shapin\Stripe\Model\MetadataTrait;

final class Coupon implements CreatableFromArray, ContainsMetadata
{
    use LivemodeTrait;
    use MetadataTrait;

    const DURATION_FOREVER = 'forever';
    const DURATION_ONCE = 'once';
    const DURATION_REPEATING = 'repeating';

    /**
     * @var string
     */
    private $id;

    /**
     * @var ?Money
     */
    private $amountOff;

    /**
     * @var \DateTimeImmutable
     */
    private $createdAt;

    /**
     * @var ?Currency
     */
    private $currency;

    /**
     * @var string
     */
    private $duration;

    /**
     * @var int
     */
    private $durationInMonths;

    /**
     * @var ?int
     */
    private $maxRedemptions;

    /**
     * @var string
     */
    private $name;

    /**
     * @var float
     */
    private $percentOff;

    /**
     * @var ?\DateTimeImmutable
     */
    private $redeemBy;

    /**
     * @var int
     */
    private $timesRedeemed;

    /**
     * @var bool
     */
    private $valid;

    public static function createFromArray(array $data): self
    {
        $model = new self();

        if (isset($data['currency'])) {
            $currency = new Currency(strtoupper($data['currency']));

            $model->amountOff = isset($data['amount_off']) ? new Money($data['amount_off'], $currency) : null;
            $model->currency = $currency;
        }

        $model->id = $data['id'];
        $model->createdAt = new \DateTimeImmutable('@'.$data['created']);
        $model->duration = $data['duration'];
        $model->durationInMonths = (int) $data['duration_in_months'];
        $model->live = $data['livemode'];
        $model->maxRedemptions = $data['max_redemptions'] ?? null;
        $model->metadata = MetadataCollection::createFromArray($data['metadata']);
        $model->name = $data['name'];
        $model->percentOff = (float) $data['percent_off'];
        $model->redeemBy = isset($data['redeem_by']) ? new \DateTimeImmutable('@'.$data['redeem_by']) : null;
        $model->timesRedeemed = (int) $data['times_redeemed'];
        $model->valid = (bool) $data['valid'];

        return $model;
    }

    public function isRepeating(): bool
    {
        return self::DURATION_REPEATING === $this->duration;
    }

    public function isOnce(): bool
    {
        return self::DURATION_ONCE === $this->duration;
    }

    public function isForever(): bool
    {
        return self::DURATION_FOREVER === $this->duration;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getAmountOff(): ?Money
    {
        return $this->amountOff;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getCurrency(): ?Currency
    {
        return $this->currency;
    }

    public function getDuration(): string
    {
        return $this->duration;
    }

    public function getDurationInMonths(): int
    {
        return $this->durationInMonths;
    }

    public function getMaxRedemptions(): ?int
    {
        return $this->maxRedemptions;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getPercentOff(): float
    {
        return $this->percentOff;
    }

    public function getRedeemBy(): ?\DateTimeImmutable
    {
        return $this->redeemBy;
    }

    public function getTimesRedeemed(): int
    {
        return $this->timesRedeemed;
    }

    public function isValid(): bool
    {
        return $this->valid;
    }
}
