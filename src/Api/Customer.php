<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Api;

use Shapin\Stripe\Configuration;
use Shapin\Stripe\Exception;
use Shapin\Stripe\Model\Customer\Customer as CustomerModel;
use Shapin\Stripe\Model\Customer\CustomerCollection;
use Symfony\Component\Config\Definition\Processor;

final class Customer extends HttpApi
{
    /**
     * @throws Exception
     */
    public function get(string $customerId)
    {
        $response = $this->httpGet("/v1/customers/$customerId");

        if (200 !== $response->getStatusCode()) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, CustomerModel::class);
    }

    /**
     * @throws Exception
     */
    public function all(array $params = [])
    {
        $searchString = '';
        if (0 < \count($params)) {
            $searchString = '?'.http_build_query($params);
        }

        $response = $this->httpGet("/v1/customers$searchString");

        if (200 !== $response->getStatusCode()) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, CustomerCollection::class);
    }

    /**
     * @throws Exception
     */
    public function create(array $params)
    {
        $processor = new Processor();
        $params = $processor->processConfiguration(new Configuration\CustomerCreate(), [$params]);

        $response = $this->httpPostRaw('/v1/customers', http_build_query($params), ['Content-Type' => 'application/x-www-form-urlencoded']);

        if (200 !== $response->getStatusCode()) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, CustomerModel::class);
    }
}
