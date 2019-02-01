<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Plan;

use Shapin\Stripe\Model\CreatableFromArray;

final class Tier implements CreatableFromArray
{
    /**
     * @var int
     */
    private $flatAmount;

    /**
     * @var int
     */
    private $unitAmount;

    /**
     * @var int
     */
    private $upTo;

    public static function createFromArray(array $data): self
    {
        $model = new self();
        $model->flatAmount = (int) $data['flat_amount'];
        $model->unitAmount = (int) $data['unit_amount'];
        $model->upTo = (int) $data['up_to'];

        return $model;
    }

    public function getFlatAmount(): int
    {
        return $this->flatAmount;
    }

    public function getUnitAmount(): int
    {
        return $this->unitAmount;
    }

    public function getUpTo(): int
    {
        return $this->upTo;
    }
}
