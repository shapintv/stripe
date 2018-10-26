<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Api;

use Shapin\Stripe\Exception;
use Shapin\Stripe\Exception\InvalidArgumentException;
use Shapin\Stripe\Model\Account\Account as AccountModel;
use Shapin\Stripe\Model\Account\AccountCollection;
use Psr\Http\Message\ResponseInterface;

final class Account extends HttpApi
{
    /**
     * @throws Exception
     */
    public function get(string $id)
    {
        $response = $this->httpGet("/v1/accounts/$id");

        if (!$this->hydrator) {
            return $response;
        }

        if ($response->getStatusCode() !== 200) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, AccountModel::class);
    }

    /**
     * @throws Exception
     */
    public function all(array $params = [])
    {
        $response = $this->httpGet('/v1/accounts'.http_build_query($params));

        if (!$this->hydrator) {
            return $response;
        }

        if ($response->getStatusCode() !== 200) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, AccountCollection::class);
    }
}
