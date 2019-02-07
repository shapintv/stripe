<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Event;

use Shapin\Stripe\Model\Plan\Plan;

trait ContainsPlanTrait
{
    use EventTrait;

    public function getPlan(): Plan
    {
        return $this->plan;
    }
}
