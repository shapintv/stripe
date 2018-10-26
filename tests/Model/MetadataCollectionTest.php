<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests\Model;

use Shapin\Stripe\Model\MetadataCollection;
use PHPUnit\Framework\TestCase;

class MetadataCollectionTest extends TestCase
{
    public function testCollection()
    {
        $elements = ['apple', 'orange', 'grape', 'plum'];

        $collection = new MetadataCollection($elements, false);

        $this->assertSame($elements, $collection->getElements());
        $this->assertFalse($collection->hasMore());
        $this->assertCount(4, $collection);

        foreach ($collection as $element) {
            $this->assertContains($element, $elements);
        }
    }
}
