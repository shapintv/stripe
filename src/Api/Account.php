<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Api;

use Shapin\Stripe\Configuration;
use Shapin\Stripe\Exception;
use Shapin\Stripe\Model\Account\Account as AccountModel;
use Shapin\Stripe\Model\Account\AccountCollection;
use Symfony\Component\Config\Definition\Processor;

final class Account extends HttpApi
{
    /**
     * @throws Exception
     */
    public function get(string $id)
    {
        $response = $this->httpGet("accounts/$id");

        return $this->hydrator->hydrate($response, AccountModel::class);
    }

    /**
     * @throws Exception
     */
    public function all(array $params = [])
    {
        $response = $this->httpGet('accounts'.http_build_query($params));

        return $this->hydrator->hydrate($response, AccountCollection::class);
    }

    /**
     * @throws Exception
     */
    public function create(array $params)
    {
        $processor = new Processor();
        $processor->processConfiguration(new Configuration\AccountCreate(), [$params]);

        $response = $this->httpPost('accounts', $params);

        return $this->hydrator->hydrate($response, AccountModel::class);
    }

    /**
     * @throws Exception
     */
    public function update(string $id, array $params)
    {
        $processor = new Processor();
        $processor->processConfiguration(new Configuration\AccountUpdate(), [$params]);

        $response = $this->httpPost("accounts/$id", $params);

        return $this->hydrator->hydrate($response, AccountModel::class);
    }
}
