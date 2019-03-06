<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Api;

use Shapin\Stripe\Configuration;
use Shapin\Stripe\Exception;
use Shapin\Stripe\Model\Refund\Refund as RefundModel;
use Shapin\Stripe\Model\Refund\RefundCollection;
use Symfony\Component\Config\Definition\Processor;

final class Refund extends HttpApi
{
    /**
     * @throws Exception
     */
    public function get(string $id)
    {
        $response = $this->httpGet("/v1/refunds/$id");

        return $this->hydrator->hydrate($response, RefundModel::class);
    }

    /**
     * @throws Exception
     */
    public function all(array $params = [])
    {
        $response = $this->httpGet('/v1/refunds', $params);

        return $this->hydrator->hydrate($response, RefundCollection::class);
    }

    /**
     * @throws Exception
     */
    public function create(array $params)
    {
        $processor = new Processor();
        $processor->processConfiguration(new Configuration\RefundCreate(), [$params]);

        $response = $this->httpPost('/v1/refunds', $params);

        return $this->hydrator->hydrate($response, RefundModel::class);
    }
}
