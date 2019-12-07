<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests\Model\Charge;

use PHPUnit\Framework\TestCase;
use Shapin\Stripe\Model\Charge\Charge;
use Shapin\Stripe\Model\Charge\Outcome;
use Shapin\Stripe\Model\MetadataCollection;
use Shapin\Stripe\Model\Refund\RefundCollection;
use Shapin\Stripe\Model\Source\Source;

class ChargeTest extends TestCase
{
    public function testCreateFromArray()
    {
        $data = json_decode(file_get_contents(__DIR__.'/../../fixtures/charges/ch_1DMyewIpafQncvOMYhZHHlxV.json'), true);

        $charge = Charge::createFromArray($data);

        $this->assertInstanceOf(Charge::class, $charge);

        $this->assertSame('3900', $charge->getAmount()->getAmount());
        $this->assertSame('0', $charge->getAmountRefunded()->getAmount());
        $this->assertNull($charge->getApplication());
        $this->assertSame('0', $charge->getApplicationFee()->getAmount());
        $this->assertSame('txn_1DMyewIpafQncvOMSlrAQjy4', $charge->getBalanceTransaction());
        $this->assertTrue($charge->isCaptured());
        $this->assertSame(1234567890, $charge->getCreatedAt()->getTimestamp());
        $this->assertSame('EUR', (string) $charge->getCurrency());
        $this->assertNull($charge->getCustomer());
        $this->assertNull($charge->getDescription());
        $this->assertNull($charge->getDestination());
        $this->assertNull($charge->getDispute());
        $this->assertNull($charge->getFailureCode());
        $this->assertNull($charge->getFailureMessage());
        $this->assertSame([], $charge->getFraudDetails());
        $this->assertNull($charge->getInvoice());
        $this->assertFalse($charge->isLive());
        $this->assertInstanceOf(MetadataCollection::class, $charge->getMetadata());
        $this->assertCount(2, $charge->getMetadata());
        $this->assertSame('123456', $charge->getMetadata()['member_id']);
        $this->assertSame('67890', $charge->getMetadata()['program_id']);
        $this->assertNull($charge->getOnBehalfOf());
        $this->assertNull($charge->getOrder());
        $this->assertInstanceOf(Outcome::class, $charge->getOutcome());
        $this->assertSame('approved_by_network', $charge->getOutcome()->getNetworkStatus());
        $this->assertNull($charge->getOutcome()->getReason());
        $this->assertSame('normal', $charge->getOutcome()->getRiskLevel());
        $this->assertSame(20, $charge->getOutcome()->getRiskScore());
        $this->assertNull($charge->getOutcome()->getRule());
        $this->assertSame('Payment complete.', $charge->getOutcome()->getSellerMessage());
        $this->assertSame('authorized', $charge->getOutcome()->getType());
        $this->assertTrue($charge->isPaid());
        $this->assertNull($charge->getPaymentIntent());
        $this->assertSame('coucou@coucou.fr', $charge->getReceiptEmail());
        $this->assertNull($charge->getReceiptNumber());
        $this->assertFalse($charge->isRefunded());
        $this->assertInstanceOf(RefundCollection::class, $charge->getRefunds());
        $this->assertCount(0, $charge->getRefunds());
        $this->assertNull($charge->getReview());
        $this->assertNull($charge->getShipping());
        $this->assertInstanceOf(Source::class, $charge->getSource());
        $this->assertNull($charge->getSourceTransfer());
        $this->assertNull($charge->getStatementDescriptor());
        $this->assertSame('succeeded', $charge->getStatus());
        $this->assertTrue($charge->isSucceeded());
        $this->assertFalse($charge->isPending());
        $this->assertFalse($charge->isFailed());
        $this->assertNull($charge->getTransfer());
        $this->assertSame('my-transfer-group', $charge->getTransferGroup());
    }
}
