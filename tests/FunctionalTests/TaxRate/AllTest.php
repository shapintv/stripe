<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests\FunctionalTests\TaxRate;

use Shapin\Stripe\Model\TaxRate\TaxRate;
use Shapin\Stripe\Model\TaxRate\TaxRateCollection;
use Shapin\Stripe\Tests\FunctionalTests\TestCase;

final class AllTest extends TestCase
{
    private $taxRateApi;

    public function setUp(): void
    {
        $this->taxRateApi = $this->getStripeClient()->taxRates();
    }

    public function testGetTaxRate()
    {
        $taxRateCollection = $this->taxRateApi->all();

        $this->assertInstanceOf(TaxRateCollection::class, $taxRateCollection);
        $this->assertCount(1, $taxRateCollection);
        $this->assertFalse($taxRateCollection->hasMore());

        foreach ($taxRateCollection as $taxRate) {
            $this->assertInstanceOf(TaxRate::class, $taxRate);
        }
    }
}
