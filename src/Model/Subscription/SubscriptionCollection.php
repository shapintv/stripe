<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Subscription;

use Shapin\Stripe\Model\Collection;

final class SubscriptionCollection extends Collection
{
    public static function createFromArray(array $data): self
    {
        $elements = [];
        foreach ($data['data'] as $element) {
            $elements[] = Subscription::createFromArray($element);
        }

        return new self($elements, $data['has_more']);
    }
}
