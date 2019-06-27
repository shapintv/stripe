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
        $response = $this->httpGet("customers/$customerId/cards/$cardId");

        return $this->hydrator->hydrate($response, CardModel::class);
    }

    /**
     * @throws Exception
     */
    public function all(string $customerId, array $params = [])
    {
        $response = $this->httpGet("customers/$customerId/cards", $params);

        return $this->hydrator->hydrate($response, CardCollection::class);
    }
}
