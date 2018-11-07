<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests\FunctionalTests\Source;

use Shapin\Stripe\Model\Source\AchCreditTransfer;
use Shapin\Stripe\Model\Source\Owner;
use Shapin\Stripe\Model\Source\Receiver;
use Shapin\Stripe\Model\Source\Source;
use Shapin\Stripe\Model\MetadataCollection;
use Shapin\Stripe\Tests\FunctionalTests\TestCase;

final class GetTest extends TestCase
{
    private $sourceApi;

    public function setUp()
    {
        $this->sourceApi = $this->getStripeClient()->sources();
    }

    public function testGet()
    {
        $source = $this->sourceApi->get('src_1DP6GIIpafQncvOMljfaGBvF');

        $this->assertInstanceOf(Source::class, $source);

        $this->assertSame('src_1DP6GIIpafQncvOMljfaGBvF', $source->getId());
        $this->assertInstanceOf(AchCreditTransfer::class, $source->getAchCreditTransfer());
        $this->assertSame('test_52796e3294dc', $source->getAchCreditTransfer()->getAccountNumber());
        $this->assertSame('TEST BANK', $source->getAchCreditTransfer()->getBankName());
        $this->assertSame('ecpwEzmBOSMOqQTL', $source->getAchCreditTransfer()->getFingerprint());
        $this->assertSame('110000000', $source->getAchCreditTransfer()->getRoutingNumber());
        $this->assertSame('TSTEZ122', $source->getAchCreditTransfer()->getSwiftCode());
        $this->assertNull($source->getAmount());
        $this->assertSame('src_client_secret_DqxDA3Xspe7eXzaKiDAhtzBz', $source->getClientSecret());
        $this->assertNull($source->getCodeVerification());
        $this->assertSame(1234567890, $source->getCreatedAt()->getTimestamp());
        $this->assertSame('USD', (string) $source->getCurrency());
        $this->assertNull($source->getCustomer());
        $this->assertSame('receiver', $source->getFlow());
        $this->assertFalse($source->isLive());
        $this->assertInstanceOf(MetadataCollection::class, $source->getMetadata());
        $this->assertCount(0, $source->getMetadata());
        $this->assertInstanceOf(Owner::class, $source->getOwner());
        $this->assertNull($source->getOwner()->getAddress());
        $this->assertSame('jenny.rosen@example.com', $source->getOwner()->getEmail());
        $this->assertNull($source->getOwner()->getName());
        $this->assertNull($source->getOwner()->getPhone());
        $this->assertNull($source->getOwner()->getVerifiedAddress());
        $this->assertNull($source->getOwner()->getVerifiedEmail());
        $this->assertNull($source->getOwner()->getVerifiedName());
        $this->assertNull($source->getOwner()->getVerifiedPhone());
        $this->assertInstanceOf(Receiver::class, $source->getReceiver());
        $this->assertSame('121042882-38381234567890123', $source->getReceiver()->getAddress());
        $this->assertSame('0', $source->getReceiver()->getAmountCharged()->getAmount());
        $this->assertSame('0', $source->getReceiver()->getAmountReceived()->getAmount());
        $this->assertSame('0', $source->getReceiver()->getAmountReturned()->getAmount());
        $this->assertNull($source->getRedirect());
        $this->assertNull($source->getStatementDescriptor());
        $this->assertSame('pending', $source->getStatus());
        $this->assertSame(Source::TYPE_ACH_CREDIT_TRANSFER, $source->getType());
        $this->assertFalse($source->isThreeDSecure());
        $this->assertSame('reusable', $source->getUsage());
    }
}
