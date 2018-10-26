<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace FAPI\Stripe\Model\BankAccount;

use FAPI\Stripe\Model\Collection;
use FAPI\Stripe\Model\CreatableFromArray;

final class BankAccountCollection extends Collection
{
    public static function createFromArray(array $data): self
    {
        $elements = [];
        foreach ($data['data'] as $element) {
            $elements[] = BankAccount::createFromArray($element);
        }

        return new self($elements, $data['has_more']);
    }
}
