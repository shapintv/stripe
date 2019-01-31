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
        $response = $this->httpGet("/v1/products/$productId");

        if (!$this->hydrator) {
            return $response;
        }

        if (200 !== $response->getStatusCode()) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, ProductModel::class);
    }

    /**
     * @throws Exception
     */
    public function create(array $params)
    {
        $processor = new Processor();
        $processor->processConfiguration(new Configuration\ProductCreate(), [$params]);

        $response = $this->httpPostRaw('/v1/products', http_build_query($params), ['Content-Type' => 'application/x-www-form-urlencoded']);

        if (!$this->hydrator) {
            return $response;
        }

        if (200 !== $response->getStatusCode()) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, ProductModel::class);
    }

    /**
     * @throws Exception
     */
    public function update(string $id, array $params)
    {
        $processor = new Processor();
        $processor->processConfiguration(new Configuration\ProductUpdate(), [$params]);

        $response = $this->httpPostRaw("/v1/products/$id", http_build_query($params), ['Content-Type' => 'application/x-www-form-urlencoded']);

        if (!$this->hydrator) {
            return $response;
        }

        if (200 !== $response->getStatusCode()) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, ProductModel::class);
    }

    /**
     * @throws Exception
     */
    public function all(array $params = [])
    {
        $searchString = '';
        if (0 < \count($params)) {
            $searchString = '?'.\http_build_query($params);
        }

        $response = $this->httpGet("/v1/products$searchString");

        if (!$this->hydrator) {
            return $response;
        }

        if (200 !== $response->getStatusCode()) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, ProductCollection::class);
    }
}
