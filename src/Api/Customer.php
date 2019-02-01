<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Api;

use Shapin\Stripe\Exception;
use Shapin\Stripe\Model\Customer\Customer as CustomerModel;
use Shapin\Stripe\Model\Customer\CustomerCollection;

final class Customer extends HttpApi
{
    /**
     * @throws Exception
     */
    public function get(string $customerId)
    {
        $response = $this->httpGet("/v1/customers/$customerId");

        if (!$this->hydrator) {
            return $response;
        }

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

        if (!$this->hydrator) {
            return $response;
        }

        if (200 !== $response->getStatusCode()) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, CustomerCollection::class);
    }
}
