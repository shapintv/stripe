<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests\FunctionalTests\Product;

use Shapin\Stripe\Model\Product\Product;
use Shapin\Stripe\Model\Product\ProductCollection;
use Shapin\Stripe\Tests\FunctionalTests\TestCase;

final class AllTest extends TestCase
{
    private $productApi;

    public function setUp(): void
    {
        $this->productApi = $this->getStripeClient()->products();
    }

    public function testGetProduct()
    {
        $productCollection = $this->productApi->all();

        $this->assertInstanceOf(ProductCollection::class, $productCollection);
        $this->assertCount(1, $productCollection);
        $this->assertFalse($productCollection->hasMore());

        foreach ($productCollection as $product) {
            $this->assertInstanceOf(Product::class, $product);
        }
    }
}
