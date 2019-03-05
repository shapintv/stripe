<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Api;

use Shapin\Stripe\Configuration;
use Shapin\Stripe\Exception;
use Shapin\Stripe\Model\Charge\Charge as ChargeModel;
use Shapin\Stripe\Model\Charge\ChargeCollection;
use Symfony\Component\Config\Definition\Processor;

final class Charge extends HttpApi
{
    /**
     * @throws Exception
     */
    public function get(string $id)
    {
        $response = $this->httpGet("/v1/charges/$id");

        return $this->hydrator->hydrate($response, ChargeModel::class);
    }

    /**
     * @throws Exception
     */
    public function create(array $params)
    {
        $processor = new Processor();
        $processor->processConfiguration(new Configuration\ChargeCreate(), [$params]);

        $response = $this->httpPost('/v1/charges', $params);

        return $this->hydrator->hydrate($response, ChargeModel::class);
    }

    /**
     * @throws Exception
     */
    public function update(string $id, array $params)
    {
        $processor = new Processor();
        $processor->processConfiguration(new Configuration\ChargeUpdate(), [$params]);

        $response = $this->httpPost("/v1/charges/$id", $params);

        return $this->hydrator->hydrate($response, ChargeModel::class);
    }

    /**
     * @throws Exception
     */
    public function all(array $params = [])
    {
        $processor = new Processor();
        $params = $processor->processConfiguration(new Configuration\ChargeList(), [$params]);

        $response = $this->httpGet('/v1/charges', $params);

        return $this->hydrator->hydrate($response, ChargeCollection::class);
    }
}
