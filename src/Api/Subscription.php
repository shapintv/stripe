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

        return $this->hydrator->hydrate($response, SubscriptionModel::class);
    }

    /**
     * @throws Exception
     */
    public function all(array $params = [])
    {
        $response = $this->httpGet('/v1/subscriptions', $params);

        return $this->hydrator->hydrate($response, SubscriptionCollection::class);
    }

    /**
     * @throws Exception
     */
    public function create(array $params)
    {
        $processor = new Processor();
        $params = $processor->processConfiguration(new Configuration\SubscriptionCreate(), [$params]);

        $response = $this->httpPost('/v1/subscriptions', $params);

        return $this->hydrator->hydrate($response, SubscriptionModel::class);
    }

    /**
     * @throws Exception
     */
    public function cancel(string $id, array $params = [])
    {
        $processor = new Processor();
        $params = $processor->processConfiguration(new Configuration\SubscriptionCancel(), [$params]);

        $response = $this->httpDelete("/v1/subscriptions/$id", $params);

        return $this->hydrator->hydrate($response, SubscriptionModel::class);
    }

    /**
     * @throws Exception
     */
    public function getItem(string $id)
    {
        $response = $this->httpGet("/v1/subscription_items/$id");

        return $this->hydrator->hydrate($response, Item::class);
    }

    /**
     * @throws Exception
     */
    public function update(string $id, array $params)
    {
        $processor = new Processor();
        $params = $processor->processConfiguration(new Configuration\SubscriptionUpdate(), [$params]);

        $response = $this->httpPost("/v1/subscriptions/$id", $params);

        return $this->hydrator->hydrate($response, SubscriptionModel::class);
    }
}
