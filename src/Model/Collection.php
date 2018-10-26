<?php

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model;

abstract class Collection extends \ArrayObject implements CreatableFromArray
{
    private $elements;
    private $hasMore;

    public function __construct(array $elements, bool $hasMore)
    {
        $this->elements = $elements;
        $this->hasMore = $hasMore;

        parent::__construct($elements);
    }

    public function getElements(): array
    {
        return $this->elements;
    }

    public function hasMore(): bool
    {
        return $this->hasMore;
    }
}
