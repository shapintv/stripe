<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests\FunctionalTests\PaymentIntent;

use Shapin\Stripe\Model\Charge\ChargeCollection;
use Shapin\Stripe\Model\PaymentIntent\PaymentIntent;
use Shapin\Stripe\Model\MetadataCollection;
use Shapin\Stripe\Tests\FunctionalTests\TestCase;

final class GetTest extends TestCase
{
    private $paymentIntentApi;

    public function setUp(): void
    {
        $this->paymentIntentApi = $this->getStripeClient()->paymentIntents();
    }

    public function testGet()
    {
        $paymentIntent = $this->paymentIntentApi->get('pi_1EUn7T2VYugoKSBzdYURrZ3e');

        $this->assertInstanceOf(PaymentIntent::class, $paymentIntent);

        $this->assertSame('pi_1EUn7T2VYugoKSBzdYURrZ3e', $paymentIntent->getId());
        $this->assertSame(1099, (int) $paymentIntent->getAmount()->getAmount());
        $this->assertSame('USD', (string) $paymentIntent->getAmount()->getCurrency());
        $this->assertSame(0, (int) $paymentIntent->getAmountCapturable()->getAmount());
        $this->assertSame('USD', (string) $paymentIntent->getAmountCapturable()->getCurrency());
        $this->assertSame(0, (int) $paymentIntent->getAmountReceived()->getAmount());
        $this->assertSame('USD', (string) $paymentIntent->getAmountReceived()->getCurrency());
        $this->assertNull($paymentIntent->getApplicationId());
        $this->assertNull($paymentIntent->getApplicationFeeAmount());
        $this->assertSame(1234567890, $paymentIntent->getCanceledAt()->getTimestamp());
        $this->assertNull($paymentIntent->getCancellationReason());
        $this->assertSame(PaymentIntent::CAPTURE_METHOD_AUTOMATIC, $paymentIntent->getCaptureMethod());

        $charges = $paymentIntent->getCharges();
        $this->assertInstanceOf(ChargeCollection::class, $charges);
        $this->assertCount(1, $charges->getElements());

        $this->assertSame('pi_1Efz8kLEfszBpMQYVMTXVaVo_secret_AxQh3HhxOQDPaNOppiE5QM4iJ', $paymentIntent->getClientSecret());
        $this->assertSame(PaymentIntent::CONFIRMATION_METHOD_AUTOMATIC, $paymentIntent->getConfirmationMethod());
        $this->assertSame(1234567890, $paymentIntent->getCreatedAt()->getTimestamp());
        $this->assertSame('USD', (string) $paymentIntent->getCurrency());
        $this->assertNull($paymentIntent->getCustomerId());
        $this->assertNull($paymentIntent->getDescription());
        $this->assertNull($paymentIntent->getInvoiceId());
        $this->assertNull($paymentIntent->getLastPaymentError());
        $this->assertNull($paymentIntent->getNextAction());
        $this->assertNull($paymentIntent->getOnBehalfOfId());
        $this->assertNull($paymentIntent->getPaymentMethodId());
        $this->assertSame(['card'], $paymentIntent->getPaymentMethodTypes());
        $this->assertNull($paymentIntent->getReceiptEmail());
        $this->assertNull($paymentIntent->getReviewId());
        $this->assertNull($paymentIntent->getShipping());
        $this->assertNull($paymentIntent->getStatementDescriptor());
        $this->assertSame(PaymentIntent::STATUS_REQUIRES_PAYMENT_METHOD, $paymentIntent->getStatus());
        $this->assertNull($paymentIntent->getTransferData());
        $this->assertNull($paymentIntent->getTransferGroup());
        $this->assertFalse($paymentIntent->isLive());
        $this->assertInstanceOf(MetadataCollection::class, $paymentIntent->getMetadata());
        $this->assertCount(0, $paymentIntent->getMetadata());
    }
}
