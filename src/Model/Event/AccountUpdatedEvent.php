<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Event;

use Shapin\Stripe\Model\Account\Account;

final class AccountUpdatedEvent implements Event
{
    use EventTrait;

    public function getAccount(): Account
    {
        return $this->account;
    }

    public function getPreviousAttributes(): array
    {
        return $this->previousAttributes;
    }
}
