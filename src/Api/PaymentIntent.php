<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Api;

use Shapin\Stripe\Configuration;
use Shapin\Stripe\Exception;
use Shapin\Stripe\Model\PaymentIntent\PaymentIntent as PaymentIntentModel;
use Shapin\Stripe\Model\PaymentIntent\PaymentIntentCollection;
use Symfony\Component\Config\Definition\Processor;

final class PaymentIntent extends HttpApi
{
    /**
     * @throws Exception
     */
    public function get(string $id)
    {
        $response = $this->httpGet("payment_intents/$id");

        return $this->hydrator->hydrate($response, PaymentIntentModel::class);
    }

    /**
     * @throws Exception
     */
    public function all(array $params = [])
    {
        $response = $this->httpGet('payment_intents', $params);

        return $this->hydrator->hydrate($response, PaymentIntentCollection::class);
    }

    /**
     * @throws Exception
     */
    public function create(array $params)
    {
        $processor = new Processor();
        $processor->processConfiguration(new Configuration\PaymentIntentCreate(), [$params]);

        $response = $this->httpPost('payment_intents', $params);

        return $this->hydrator->hydrate($response, PaymentIntentModel::class);
    }

    /**
     * @throws Exception
     */
    public function confirm(string $id, array $params = [])
    {
        $processor = new Processor();
        $processor->processConfiguration(new Configuration\PaymentIntentConfirm(), [$params]);

        $response = $this->httpPost("payment_intents/$id/confirm", $params);

        return $this->hydrator->hydrate($response, PaymentIntentModel::class);
    }
}
