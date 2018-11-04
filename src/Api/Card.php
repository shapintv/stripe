<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Api;

use Shapin\Stripe\Exception;
use Shapin\Stripe\Model\Card\Card as CardModel;
use Shapin\Stripe\Model\Card\CardCollection;

final class Card extends HttpApi
{
    /**
     * @throws Exception
     */
    public function get(string $customerId, string $cardId)
    {
        $response = $this->httpGet("/v1/customers/$customerId/cards/$cardId");

        if (!$this->hydrator) {
            return $response;
        }

        if (200 !== $response->getStatusCode()) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, CardModel::class);
    }

    /**
     * @throws Exception
     */
    public function all(string $customerId, array $params = [])
    {
        $response = $this->httpGet("/v1/customers/$customerId/cards".http_build_query($params));

        if (!$this->hydrator) {
            return $response;
        }

        if (200 !== $response->getStatusCode()) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, CardCollection::class);
    }
}
