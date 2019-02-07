<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Event;

use Shapin\Stripe\Model\Discount\Discount;

final class CustomerDiscountUpdatedEvent implements Event
{
    use EventTrait;

    public function getDiscount(): Discount
    {
        return $this->discount;
    }

    public function getPreviousAttributes(): array
    {
        return $this->previousAttributes;
    }
}
