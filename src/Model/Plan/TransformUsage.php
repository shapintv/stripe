<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Plan;

use Shapin\Stripe\Model\CreatableFromArray;

final class TransformUsage implements CreatableFromArray
{
    const ROUND_UP = 'up';
    const ROUND_DOWN = 'down';

    /**
     * @var int
     */
    private $divideBy;

    /**
     * @var string
     */
    private $round;

    public static function createFromArray(array $data): self
    {
        $model = new self();
        $model->divideBy = (int) $data['divide_by'];
        $model->round = $data['round'];

        return $model;
    }

    public function getDivideBy(): int
    {
        return $this->divideBy;
    }

    public function getRound(): string
    {
        return $this->round;
    }
}
