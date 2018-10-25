<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace FAPI\Stripe\Tests\Model;

use FAPI\Stripe\Model\Collection;
use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase
{
    public function testCollection()
    {
        $elements = ['apple', 'orange', 'grape', 'plum'];

        $collection = new Collection($elements, false);

        $this->assertSame($elements, $collection->getElements());
        $this->assertFalse($collection->hasMore());
        $this->assertCount(4, $collection);

        foreach ($collection as $element) {
            $this->assertContains($element, $elements);
        }
    }
}
