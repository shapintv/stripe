<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Event;

use Shapin\Stripe\Model\BankAccount\BankAccount;

trait ContainsBankAccountTrait
{
    use EventTrait;

    public function getBankAccount(): BankAccount
    {
        return $this->bankAccount;
    }
}
