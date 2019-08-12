<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Api;

use Shapin\Stripe\Configuration;
use Shapin\Stripe\Exception;
use Shapin\Stripe\Model\SetupIntent\Item;
use Shapin\Stripe\Model\SetupIntent\SetupIntent as SetupIntentModel;
use Shapin\Stripe\Model\SetupIntent\SetupIntentCollection;
use Symfony\Component\Config\Definition\Processor;

final class SetupIntent extends HttpApi
{
    /**
     * @throws Exception
     */
    public function get(string $id)
    {
        $response = $this->httpGet("setup_intents/$id");

        return $this->hydrator->hydrate($response, SetupIntentModel::class);
    }

    /**
     * @throws Exception
     */
    public function all(array $params = [])
    {
        $response = $this->httpGet('setup_intents', $params);

        return $this->hydrator->hydrate($response, SetupIntentCollection::class);
    }

    /**
     * @throws Exception
     */
    public function create(array $params)
    {
        $processor = new Processor();
        $processor->processConfiguration(new Configuration\SetupIntentCreate(), [$params]);

        $response = $this->httpPost('setup_intents', $params);

        return $this->hydrator->hydrate($response, SetupIntentModel::class);
    }
}
