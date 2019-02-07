<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Event;

use Shapin\Stripe\Model\Charge\Charge;

trait ContainsChargeTrait
{
    use EventTrait;

    public function getCharge(): Charge
    {
        return $this->charge;
    }
}
