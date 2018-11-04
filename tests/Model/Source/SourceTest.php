<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests\Model\Source;

use Shapin\Stripe\Model\Source\Card;
use Shapin\Stripe\Model\Source\Owner;
use Shapin\Stripe\Model\Source\Source;
use Shapin\Stripe\Model\MetadataCollection;
use PHPUnit\Framework\TestCase;

class SourceTest extends TestCase
{
    public function testCreateFromArray()
    {
        $data = json_decode(file_get_contents(__DIR__.'/../../fixtures/sources/src_1DRKIVIpafQncvOMg0qev4dH.json'), true);

        $source = Source::createFromArray($data);

        $this->assertInstanceOf(Source::class, $source);
        $this->assertSame('src_1DRKIVIpafQncvOMg0qev4dH', $source->getId());
        $this->assertNull($source->getAchCreditTransfer());
        $this->assertNull($source->getAmount());
        $this->assertInstanceOf(Card::class, $source->getCard());
        $this->assertNull($source->getCard()->getAddressLine1Check());
        $this->assertNull($source->getCard()->getAddressZipCheck());
        $this->assertSame('Visa', $source->getCard()->getBrand());
        $this->assertSame('FR', $source->getCard()->getCountry());
        $this->assertSame('unchecked', $source->getCard()->getCvcCheck());
        $this->assertNull($source->getCard()->getDynamicLastFour());
        $this->assertSame(2, $source->getCard()->getExpirationMonth());
        $this->assertSame(2021, $source->getCard()->getExpirationYear());
        $this->assertSame('8J0hhCks6oaRa2eE', $source->getCard()->getFingerprint());
        $this->assertSame('credit', $source->getCard()->getFunding());
        $this->assertSame('0003', $source->getCard()->getLastFour());
        $this->assertNull($source->getCard()->getName());
        $this->assertSame('optional', $source->getCard()->getThreeDSecure());
        $this->assertNull($source->getCard()->getTokenizationMethod());
        $this->assertFalse($source->getCard()->isThreeDSecureRequired());
        $this->assertFalse($source->getCard()->isThreeDSecureRecommended());
        $this->assertTrue($source->getCard()->isThreeDSecureOptional());
        $this->assertTrue($source->getCard()->isThreeDSecureSupported());
        $this->assertSame('src_client_secret_Dt6bIBUoRf18XUxjB6KrvTxJ', $source->getClientSecret());
        $this->assertNull($source->getCodeVerification());
        $this->assertSame(1234567890, $source->getCreatedAt()->getTimestamp());
        $this->assertNull($source->getCurrency());
        $this->assertNull($source->getCustomer());
        $this->assertSame('none', $source->getFlow());
        $this->assertFalse($source->isLive());
        $this->assertInstanceOf(MetadataCollection::class, $source->getMetadata());
        $this->assertCount(0, $source->getMetadata());
        $this->assertInstanceOf(Owner::class, $source->getOwner());
        $this->assertNull($source->getOwner()->getAddress());
        $this->assertNull($source->getOwner()->getEmail());
        $this->assertNull($source->getOwner()->getName());
        $this->assertNull($source->getOwner()->getPhone());
        $this->assertNull($source->getOwner()->getVerifiedAddress());
        $this->assertNull($source->getOwner()->getVerifiedEmail());
        $this->assertNull($source->getOwner()->getVerifiedName());
        $this->assertNull($source->getOwner()->getVerifiedPhone());
        $this->assertNull($source->getReceiver());
        $this->assertNull($source->getRedirect());
        $this->assertNull($source->getStatementDescriptor());
        $this->assertSame('chargeable', $source->getStatus());
        $this->assertSame('card', $source->getType());
        $this->assertSame('reusable', $source->getUsage());
    }
}
