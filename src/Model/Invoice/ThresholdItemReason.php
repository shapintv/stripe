<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Invoice;

use Shapin\Stripe\Model\CreatableFromArray;

final class ThresholdItemReason implements CreatableFromArray
{
    /**
     * @var array
     */
    private $lineItemIds;

    /**
     * @var int
     */
    private $usageGte;

    public static function createFromArray(array $data): self
    {
        $model = new self();
        $model->lineItemIds = $data['line_item_ids'];
        $model->usageGte = (int) $data['usage_gte'];

        return $model;
    }

    public function getLineItemIds(): array
    {
        return $this->lineItemsIds;
    }

    public function getUsageGte(): int
    {
        return $this->usageGte;
    }
}
