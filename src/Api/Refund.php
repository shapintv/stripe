<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Api;

use Psr\Http\Message\ResponseInterface;
use Shapin\Stripe\Configuration;
use Shapin\Stripe\Exception;
use Shapin\Stripe\Exception\Domain\Refund as RefundExceptions;
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

        if (!$this->hydrator) {
            return $response;
        }

        if (200 !== $response->getStatusCode()) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, RefundModel::class);
    }

    /**
     * @throws Exception
     */
    public function all(array $params = [])
    {
        $response = $this->httpGet('/v1/refunds'.http_build_query($params));

        if (!$this->hydrator) {
            return $response;
        }

        if (200 !== $response->getStatusCode()) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, RefundCollection::class);
    }

    /**
     * @throws Exception
     */
    public function create(array $params)
    {
        $processor = new Processor();
        $processor->processConfiguration(new Configuration\RefundCreate(), [$params]);

        $response = $this->httpPostRaw('/v1/refunds', http_build_query($params), ['Content-Type' => 'application/x-www-form-urlencoded']);

        if (!$this->hydrator) {
            return $response;
        }

        if (200 !== $response->getStatusCode()) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, RefundModel::class);
    }

    /**
     * {@inheritdoc}
     */
    protected function handleErrors(ResponseInterface $response)
    {
        if (400 === $response->getStatusCode()) {
            $body = json_decode((string) $response->getBody(), true);
            if (isset($body['error']['code'])) {
                switch ($body['error']['code']) {
                    case 'charge_already_refunded':
                        throw new RefundExceptions\ChargeAlreadyRefundedException($response);
                }
            }
        }

        parent::handleErrors($response);
    }
}
