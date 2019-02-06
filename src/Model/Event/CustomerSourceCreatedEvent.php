<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Event;

use Shapin\Stripe\Model\Source\Source;

final class CustomerSourceCreatedEvent implements Event
{
    use EventTrait;

    public function getSource(): Source
    {
        return $this->source;
    }
}
