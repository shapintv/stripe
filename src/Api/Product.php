<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Api;

use Shapin\Stripe\Configuration;
use Shapin\Stripe\Exception;
use Shapin\Stripe\Model\Product\Product as ProductModel;
use Shapin\Stripe\Model\Product\ProductCollection;
use Symfony\Component\Config\Definition\Processor;

final class Product extends HttpApi
{
    /**
     * @throws Exception
     */
    public function get(string $productId)
    {
        $response = $this->httpGet("products/$productId");

        return $this->hydrator->hydrate($response, ProductModel::class);
    }

    /**
     * @throws Exception
     */
    public function create(array $params)
    {
        $processor = new Processor();
        $params = $processor->processConfiguration(new Configuration\ProductCreate(), [$params]);

        $response = $this->httpPost('products', $params);

        return $this->hydrator->hydrate($response, ProductModel::class);
    }

    /**
     * @throws Exception
     */
    public function update(string $id, array $params)
    {
        $processor = new Processor();
        $params = $processor->processConfiguration(new Configuration\ProductUpdate(), [$params]);

        $response = $this->httpPost("products/$id", $params);

        return $this->hydrator->hydrate($response, ProductModel::class);
    }

    /**
     * @throws Exception
     */
    public function all(array $params = [])
    {
        $response = $this->httpGet('products', $params);

        return $this->hydrator->hydrate($response, ProductCollection::class);
    }
}
