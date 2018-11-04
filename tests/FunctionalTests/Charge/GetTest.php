<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests\FunctionalTests\Charge;

use Shapin\Stripe\Model\Account\Account;
use Shapin\Stripe\Model\Charge\Charge;
use Shapin\Stripe\Model\MetadataCollection;
use Shapin\Stripe\Model\Refund\Refund;
use Shapin\Stripe\Model\Refund\RefundCollection;
use Shapin\Stripe\Tests\FunctionalTests\TestCase;

final class GetTest extends TestCase
{
    private $chargeApi;

    public function setUp()
    {
        $this->chargeApi = $this->getStripeClient()->charges();
    }

    public function testGet()
    {
        $charge = $this->chargeApi->get('ch_1DMGYDG873roFXQAd5iIC0eO');

        $this->assertInstanceOf(Charge::class, $charge);

        $this->assertSame('100', $charge->getAmount()->getAmount());
        $this->assertSame('0', $charge->getAmountRefunded()->getAmount());
        $this->assertNull($charge->getApplication());
        $this->assertSame('0', $charge->getApplicationFee()->getAmount());
        $this->assertSame('txn_1DPFJCFgK3s3qfchldRdMy4Z', $charge->getBalanceTransaction());
        $this->assertFalse($charge->isCaptured());
        $this->assertSame(1234567890, $charge->getCreatedAt()->getTimestamp());
        $this->assertSame('USD', (string) $charge->getCurrency());
        $this->assertNull($charge->getCustomer());
        $this->assertSame('My First Test Charge (created for API docs)', $charge->getDescription());
        $this->assertNull($charge->getDestination());
        $this->assertNull($charge->getDispute());
        $this->assertNull($charge->getFailureCode());
        $this->assertNull($charge->getFailureMessage());
        $this->assertSame([], $charge->getFraudDetails());
        $this->assertNull($charge->getInvoice());
        $this->assertFalse($charge->isLive());
        $this->assertInstanceOf(MetadataCollection::class, $charge->getMetadata());
        $this->assertCount(0, $charge->getMetadata());
        $this->assertNull($charge->getOnBehalfOf());
        $this->assertNull($charge->getOrder());
        $this->assertNull($charge->getOutcome());
        $this->assertTrue($charge->isPaid());
        $this->assertNull($charge->getPaymentIntent());
        $this->assertNull($charge->getReceiptEmail());
        $this->assertNull($charge->getReceiptNumber());
        $this->assertFalse($charge->isRefunded());
        $this->assertInstanceOf(RefundCollection::class, $charge->getRefunds());
        $this->assertCount(1, $charge->getRefunds());
        $this->assertInstanceOf(Refund::class, $charge->getRefunds()[0]);
        $this->assertNull($charge->getReview());
        $this->assertNull($charge->getShipping());
        $this->assertInstanceOf(Account::class, $charge->getSource());
        $this->assertNull($charge->getSourceTransfer());
        $this->assertNull($charge->getStatementDescriptor());
        $this->assertSame('succeeded', $charge->getStatus());
        $this->assertNull($charge->getTransfer());
        $this->assertNull($charge->getTransferGroup());
    }
}
