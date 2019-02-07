<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Event;

use Shapin\Stripe\Model\BankAccount\BankAccount;
use Shapin\Stripe\Model\Card\Card;

interface ContainsExternalAccount extends Event
{
    public function getBankAccount(): ?BankAccount;

    public function getCard(): ?Card;
}
