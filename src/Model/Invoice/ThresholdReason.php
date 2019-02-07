<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Invoice;

use Shapin\Stripe\Model\CreatableFromArray;

final class ThresholdReason implements CreatableFromArray
{
    /**
     * @var int
     */
    private $amountGte;

    /**
     * @var array
     */
    private $itemReasons;

    public static function createFromArray(array $data): self
    {
        $itemReasons = [];
        foreach ($data['item_reasons'] as $itemReason) {
            $itemReasons[] = ThresholdItemReason::createFromArray($itemReason);
        }

        $model = new self();
        $model->amountGte = (int) $data['amount_gte'];
        $model->itemReasons = $itemReasons;

        return $model;
    }

    public function getAmountGte(): int
    {
        return $this->amountGte;
    }

    public function getItemReasons(): array
    {
        return $this->itemReasons;
    }
}
