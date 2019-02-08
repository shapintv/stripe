<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests\FunctionalTests\Product;

use Shapin\Stripe\Model\Product\Product;
use Shapin\Stripe\Tests\FunctionalTests\TestCase;

final class GetTest extends TestCase
{
    private $productApi;

    public function setUp(): void
    {
        $this->productApi = $this->getStripeClient()->products();
    }

    public function testGet()
    {
        $product = $this->productApi->get('an_id');

        $this->assertInstanceOf(Product::class, $product);

        $this->assertSame('an_id', $product->getId());
        $this->assertTrue($product->isActive());
        $this->assertSame([], $product->getAttributes());
        $this->assertNull($product->getCaption());
        $this->assertSame(1234567890, $product->getCreatedAt()->getTimestamp());
        $this->assertSame([], $product->getDeactivateOn());
        $this->assertNull($product->getDescription());
        $this->assertSame([], $product->getImages());
        $this->assertSame('Gold Special', $product->getName());
        $this->assertNull($product->getPackageDimension());
        $this->assertFalse($product->isShippable());
        $this->assertNull($product->getStatementDescriptor());
        $this->assertSame('service', $product->getType());
        $this->assertNull($product->getUnitLabel());
        $this->assertSame(1234567890, $product->getUpdatedAt()->getTimestamp());
        $this->assertNull($product->getUrl());
    }
}
