<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Api;

use Shapin\Stripe\Configuration;
use Shapin\Stripe\Exception;
use Shapin\Stripe\Model\Plan\Plan as PlanModel;
use Shapin\Stripe\Model\Plan\PlanCollection;
use Symfony\Component\Config\Definition\Processor;

final class Plan extends HttpApi
{
    /**
     * @throws Exception
     */
    public function get(string $id)
    {
        $response = $this->httpGet("plans/$id");

        return $this->hydrator->hydrate($response, PlanModel::class);
    }

    /**
     * @throws Exception
     */
    public function all(array $params = [])
    {
        $response = $this->httpGet('plans', $params);

        return $this->hydrator->hydrate($response, PlanCollection::class);
    }

    /**
     * @throws Exception
     */
    public function create(array $params)
    {
        $processor = new Processor();
        $params = $processor->processConfiguration(new Configuration\PlanCreate(), [$params]);

        if (isset($params['existing_product'])) {
            $params['product'] = $params['existing_product'];
            unset($params['existing_product']);
        }

        $response = $this->httpPost('plans', $params);

        return $this->hydrator->hydrate($response, PlanModel::class);
    }

    /**
     * @throws Exception
     */
    public function update(string $id, array $params)
    {
        $processor = new Processor();
        $processor->processConfiguration(new Configuration\PlanUpdate(), [$params]);

        $response = $this->httpPost("plans/$id", $params);

        return $this->hydrator->hydrate($response, PlanModel::class);
    }
}
