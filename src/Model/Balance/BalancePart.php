<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace FAPI\Stripe\Model\Balance;

use FAPI\Stripe\Model\CreatableFromArray;
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

    private function __construct(Money $amount, array $sourceTypes = [])
    {
        $this->amount = $amount;
        $this->sourceTypes= $sourceTypes;
    }

    public static function createFromArray(array $data): self
    {
        return new self(
            new Money($data['amount'], new Currency(strtoupper($data['currency']))),
            isset($data['source_types']) ? $data['source_types'] : []
        );
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
