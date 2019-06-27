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
        $response = $this->httpGet("customers/$customerId");

        return $this->hydrator->hydrate($response, CustomerModel::class);
    }

    /**
     * @throws Exception
     */
    public function all(array $params = [])
    {
        $response = $this->httpGet('customers', $params);

        return $this->hydrator->hydrate($response, CustomerCollection::class);
    }

    /**
     * @throws Exception
     */
    public function create(array $params)
    {
        $processor = new Processor();
        $params = $processor->processConfiguration(new Configuration\CustomerCreate(), [$params]);

        $response = $this->httpPost('customers', $params);

        return $this->hydrator->hydrate($response, CustomerModel::class);
    }

    /**
     * @throws Exception
     */
    public function update(string $id, array $params)
    {
        $processor = new Processor();
        $params = $processor->processConfiguration(new Configuration\CustomerUpdate(), [$params]);

        $response = $this->httpPost("customers/$id", $params);

        return $this->hydrator->hydrate($response, CustomerModel::class);
    }
}
