<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Event;

use Shapin\Stripe\Model\Product\Product;

final class ProductDeletedEvent implements Event
{
    use EventTrait;

    public function getProduct(): Product
    {
        return $this->product;
    }
}
