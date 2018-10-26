<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace FAPI\Stripe\Model\Account;

use FAPI\Stripe\Exception\InvalidArgumentException;
use FAPI\Stripe\Model\BankAccount\BankAccount;
use FAPI\Stripe\Model\Card\Card;
use FAPI\Stripe\Model\Collection;
use FAPI\Stripe\Model\CreatableFromArray;

final class ExternalAccountCollection extends Collection
{
    public static function createFromArray(array $data): self
    {
        $elements = [];
        foreach ($data['data'] as $element) {
            switch ($element['object']) {
                case 'bank_account':
                    $elements[] = BankAccount::createFromArray($element);
                    break;
                case 'card':
                    $elements[] = Card::createFromArray($element);
                    break;
                default:
                    throw new InvalidArgumentException('Unknown external account type: '.$element['object']);
            }
        }

        return new self($elements, $data['has_more']);
    }
}
