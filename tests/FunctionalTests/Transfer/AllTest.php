<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests\FunctionalTests\Transfer;

use Shapin\Stripe\Model\Transfer\Transfer;
use Shapin\Stripe\Model\Transfer\TransferCollection;
use Shapin\Stripe\Tests\FunctionalTests\TestCase;

final class AllTest extends TestCase
{
    private $transferApi;

    public function setUp(): void
    {
        $this->transferApi = $this->getStripeClient()->transfers();
    }

    public function testGetTransfer()
    {
        $transferCollection = $this->transferApi->all();

        $this->assertInstanceOf(TransferCollection::class, $transferCollection);
        $this->assertCount(1, $transferCollection);
        $this->assertFalse($transferCollection->hasMore());

        foreach ($transferCollection as $transfer) {
            $this->assertInstanceOf(Transfer::class, $transfer);
        }
    }
}
