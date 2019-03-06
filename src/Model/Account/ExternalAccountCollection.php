<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Account;

use Shapin\Stripe\Exception\InvalidArgumentException;
use Shapin\Stripe\Model\BankAccount\BankAccount;
use Shapin\Stripe\Model\Card\Card;
use Shapin\Stripe\Model\Collection;

final class ExternalAccountCollection extends Collection
{
    public static function createFromArray(array $data): self
    {
        $elements = [];
        if (isset($data['data'])) {
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
        }

        return new self($elements, $data['has_more'] ?? false);
    }
}
