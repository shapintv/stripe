<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Balance;

use Shapin\Stripe\Model\CreatableFromArray;
use Money\Currency;
use Money\Money;

final class BalancePart implements CreatableFromArray
{
    /**
     * @var Money
     */
    private $amount;

    /**
     * @var SourceType[]
     */
    private $sourceTypes;

    private function __construct()
    {
    }

    public static function createFromArray(array $data): self
    {
        $model = new self();
        $model->amount = new Money($data['amount'], new Currency(strtoupper($data['currency'])));
        $model->sourceTypes = $data['source_types'] ?? [];

        return $model;
    }

    public function getAmount(): Money
    {
        return $this->amount;
    }

    public function getSourceTypes(): array
    {
        return $this->sourceTypes;
    }
}
