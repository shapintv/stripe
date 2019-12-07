<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests\FunctionalTests\TaxRate;

use Shapin\Stripe\Model\MetadataCollection;
use Shapin\Stripe\Model\TaxRate\TaxRate;
use Shapin\Stripe\Tests\FunctionalTests\TestCase;

final class GetTest extends TestCase
{
    private $taxRateApi;

    public function setUp(): void
    {
        $this->taxRateApi = $this->getStripeClient()->taxRates();
    }

    public function testGet()
    {
        $taxRate = $this->taxRateApi->get('txr_1EmcRFIpafQncvOMSZkLv57B');

        $this->assertInstanceOf(TaxRate::class, $taxRate);

        $this->assertSame('txr_1EmcRFIpafQncvOMSZkLv57B', $taxRate->getId());
        $this->assertTrue($taxRate->isActive());
        $this->assertSame(1234567890, $taxRate->getCreatedAt()->getTimestamp());
        $this->assertSame('VAT Germany', $taxRate->getDescription());
        $this->assertSame('VAT', $taxRate->getDisplayName());
        $this->assertFalse($taxRate->isInclusive());
        $this->assertSame('DE', $taxRate->getJurisdiction());
        $this->assertSame(19.0, $taxRate->getPercentage());
        $this->assertFalse($taxRate->isLive());
        $this->assertInstanceOf(MetadataCollection::class, $taxRate->getMetadata());
        $this->assertCount(0, $taxRate->getMetadata());
    }
}
