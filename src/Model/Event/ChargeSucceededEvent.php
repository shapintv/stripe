<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Event;

final class ChargeSucceededEvent implements ContainsCharge
{
    use ContainsChargeTrait;
}
