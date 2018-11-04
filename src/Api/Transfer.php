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

        if (!$this->hydrator) {
            return $response;
        }

        if (200 !== $response->getStatusCode()) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, TransferModel::class);
    }

    /**
     * @throws Exception
     */
    public function all(array $params = [])
    {
        $processor = new Processor();
        $processor->processConfiguration(new Configuration\TransferList(), [$params]);

        $searchString = '';
        if (0 < \count($params)) {
            $searchString = '?'.http_build_query($params);
        }

        $response = $this->httpGet('/v1/transfers'.$searchString);

        if (!$this->hydrator) {
            return $response;
        }

        if (200 !== $response->getStatusCode()) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, TransferCollection::class);
    }

    /**
     * @throws Exception
     */
    public function create(array $params)
    {
        $processor = new Processor();
        $processor->processConfiguration(new Configuration\TransferCreate(), [$params]);

        $response = $this->httpPostRaw('/v1/transfers', http_build_query($params), ['Content-Type' => 'application/x-www-form-urlencoded']);

        if (!$this->hydrator) {
            return $response;
        }

        if (200 !== $response->getStatusCode()) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, TransferModel::class);
    }
}