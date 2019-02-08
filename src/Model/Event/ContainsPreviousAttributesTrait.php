<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Event;

trait ContainsPreviousAttributesTrait
{
    // Commented cause it fails on travis for PHP < 7.3
    // It looks like it's not possible to se 2 traits using the same other trait in a given class...
    //use EventTrait;

    public function getPreviousAttributes(): array
    {
        return $this->previousAttributes;
    }
}
