<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests\FunctionalTests\Transfer;

use Shapin\Stripe\Model\Transfer\Transfer;
use Shapin\Stripe\Model\Transfer\TransferReversal;
use Shapin\Stripe\Model\Transfer\TransferReversalCollection;
use Shapin\Stripe\Model\MetadataCollection;
use Shapin\Stripe\Tests\FunctionalTests\TestCase;

final class GetTest extends TestCase
{
    private $transferApi;

    public function setUp(): void
    {
        $this->transferApi = $this->getStripeClient()->transfers();
    }

    public function testGet()
    {
        $transfer = $this->transferApi->get('tr_164xRv2eZvKYlo2CZxJZWm1E');

        $this->assertInstanceOf(Transfer::class, $transfer);

        $this->assertSame('tr_164xRv2eZvKYlo2CZxJZWm1E', $transfer->getId());
        $this->assertSame('1100', $transfer->getAmount()->getAmount());
        $this->assertSame('0', $transfer->getAmountReversed()->getAmount());
        $this->assertIsString($transfer->getBalanceTransaction());
        $this->assertSame(1234567890, $transfer->getCreatedAt()->getTimestamp());
        $this->assertSame('USD', (string) $transfer->getCurrency());
        $this->assertNull($transfer->getDescription());
        $this->assertIsString($transfer->getDestination());
        $this->assertIsString($transfer->getDestinationPayment());
        $this->assertFalse($transfer->isLive());
        $this->assertInstanceOf(MetadataCollection::class, $transfer->getMetadata());
        $this->assertCount(0, $transfer->getMetadata());
        $this->assertInstanceOf(TransferReversalCollection::class, $transfer->getTransferReversals());
        $this->assertCount(1, $transfer->getTransferReversals());
        $reversal = $transfer->getTransferReversals()[0];
        $this->assertInstanceOf(TransferReversal::class, $reversal);
        $this->assertIsString($reversal->getId());
        $this->assertSame('1100', $reversal->getAmount()->getAmount());
        $this->assertSame(1234567890, $reversal->getCreatedAt()->getTimestamp());
        $this->assertSame('USD', (string) $reversal->getCurrency());
        $this->assertNull($reversal->getDestinationPaymentRefund());
        $this->assertInstanceOf(MetadataCollection::class, $reversal->getMetadata());
        $this->assertCount(0, $reversal->getMetadata());
        $this->assertNull($reversal->getSourceRefund());
        $this->assertIsString($reversal->getTransfer());
        $this->assertFalse($transfer->isReversed());
        $this->assertNull($transfer->getSourceTransaction());
        $this->assertSame('card', $transfer->getSourceType());
        $this->assertNull($transfer->getTransferGroup());
    }
}
