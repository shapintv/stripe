<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Api;

use Shapin\Stripe\Configuration;
use Shapin\Stripe\Exception;
use Shapin\Stripe\Model\Subscription\Item;
use Shapin\Stripe\Model\Subscription\Subscription as SubscriptionModel;
use Shapin\Stripe\Model\Subscription\SubscriptionCollection;
use Symfony\Component\Config\Definition\Processor;

final class Subscription extends HttpApi
{
    /**
     * @throws Exception
     */
    public function get(string $id)
    {
        $response = $this->httpGet("/v1/subscriptions/$id");

        if (!$this->hydrator) {
            return $response;
        }

        if (200 !== $response->getStatusCode()) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, SubscriptionModel::class);
    }

    /**
     * @throws Exception
     */
    public function all(array $params = [])
    {
        $response = $this->httpGet('/v1/subscriptions'.http_build_query($params));

        if (!$this->hydrator) {
            return $response;
        }

        if (200 !== $response->getStatusCode()) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, SubscriptionCollection::class);
    }

    /**
     * @throws Exception
     */
    public function create(array $params)
    {
        $processor = new Processor();
        $params = $processor->processConfiguration(new Configuration\SubscriptionCreate(), [$params]);

        $response = $this->httpPostRaw('/v1/subscriptions', http_build_query($params), ['Content-Type' => 'application/x-www-form-urlencoded']);

        if (!$this->hydrator) {
            return $response;
        }

        if (200 !== $response->getStatusCode()) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, SubscriptionModel::class);
    }

    /**
     * @throws Exception
     */
    public function cancel(string $id, array $params = [])
    {
        $processor = new Processor();
        $params = $processor->processConfiguration(new Configuration\SubscriptionCancel(), [$params]);

        $response = $this->httpDelete("/v1/subscriptions/$id?".http_build_query($params));

        if (!$this->hydrator) {
            return $response;
        }

        if (200 !== $response->getStatusCode()) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, SubscriptionModel::class);
    }

    /**
     * @throws Exception
     */
    public function getItem(string $id)
    {
        $response = $this->httpGet("/v1/subscription_items/$id");

        if (!$this->hydrator) {
            return $response;
        }

        if (200 !== $response->getStatusCode()) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, Item::class);
    }
}
