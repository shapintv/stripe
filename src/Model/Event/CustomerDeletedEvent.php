<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Event;

use Shapin\Stripe\Model\Customer\Customer;

final class CustomerDeletedEvent implements Event
{
    use EventTrait;

    public function getCustomer(): Customer
    {
        return $this->customer;
    }
}
