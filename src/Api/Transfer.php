<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Api;

use Shapin\Stripe\Configuration;
use Shapin\Stripe\Exception;
use Shapin\Stripe\Model\Transfer\Transfer as TransferModel;
use Shapin\Stripe\Model\Transfer\TransferCollection;
use Symfony\Component\Config\Definition\Processor;

final class Transfer extends HttpApi
{
    /**
     * @throws Exception
     */
    public function get(string $id)
    {
        $response = $this->httpGet("/v1/transfers/$id");

        return $this->hydrator->hydrate($response, TransferModel::class);
    }

    /**
     * @throws Exception
     */
    public function all(array $params = [])
    {
        $processor = new Processor();
        $params = $processor->processConfiguration(new Configuration\TransferList(), [$params]);

        $response = $this->httpGet('/v1/transfers', $params);

        return $this->hydrator->hydrate($response, TransferCollection::class);
    }

    /**
     * @throws Exception
     */
    public function create(array $params)
    {
        $processor = new Processor();
        $processor->processConfiguration(new Configuration\TransferCreate(), [$params]);

        $response = $this->httpPost('/v1/transfers', $params);

        return $this->hydrator->hydrate($response, TransferModel::class);
    }
}
