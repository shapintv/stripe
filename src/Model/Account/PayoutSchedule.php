<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Account;

use Shapin\Stripe\Model\CreatableFromArray;

final class PayoutSchedule implements CreatableFromArray
{
    /**
     * @var int
     */
    private $delayDays;

    /**
     * @var string
     */
    private $interval;

    /**
     * @var ?int
     */
    private $monthlyAnchor;

    /**
     * @var ?string
     */
    private $weeklyAnchor;

    private function __construct()
    {
    }

    public static function createFromArray(array $data): self
    {
        $model = new self();
        $model->delayDays = (int) $data['delay_days'];
        $model->interval = $data['interval'];
        $model->monthlyAnchor = $data['monthly_anchor'] ?? null;
        $model->weeklyAnchor = $data['interval'] ?? null;

        return $model;
    }

    public function getDelayDays(): int
    {
        return $this->delayDays;
    }

    public function getInterval(): string
    {
        return $this->interval;
    }

    public function getMonthlyAnchor(): ?int
    {
        return $this->monthlyAnchor;
    }

    public function getWeeklyAnchor(): ?string
    {
        return $this->weeklyAnchor;
    }
}
