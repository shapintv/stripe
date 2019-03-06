<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests\Model\Account;

use Shapin\Stripe\Model\Account\ExternalAccountCollection;
use PHPUnit\Framework\TestCase;

class ExternalAccountCollectionTest extends TestCase
{
    public function testCreateWithEmptyArray()
    {
        $collection = ExternalAccountCollection::createFromArray([]);

        $this->assertInstanceOf(ExternalAccountCollection::class, $collection);
        $this->assertSame(0, count($collection->getElements()));
        $this->assertFalse($collection->hasMore());
    }
}
