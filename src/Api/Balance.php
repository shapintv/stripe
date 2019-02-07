<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Api;

use Shapin\Stripe\Exception;
use Shapin\Stripe\Model\Balance\Balance as BalanceModel;
use Shapin\Stripe\Model\Balance\BalanceTransaction;
use Shapin\Stripe\Model\Balance\BalanceTransactionCollection;

final class Balance extends HttpApi
{
    /**
     * @throws Exception
     */
    public function get(string $stripeAccount = null)
    {
        $headers = [];
        if (null !== $stripeAccount) {
            $headers = ['Stripe-Account' => $stripeAccount];
        }

        $response = $this->httpGet('/v1/balance', [], $headers);

        if (200 !== $response->getStatusCode()) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, BalanceModel::class);
    }

    /**
     * @throws Exception
     */
    public function getBalanceTransaction(string $id)
    {
        $response = $this->httpGet("/v1/balance/history/$id");

        if (200 !== $response->getStatusCode()) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, BalanceTransaction::class);
    }

    /**
     * @throws Exception
     */
    public function getBalanceTransactions(array $params = [])
    {
        $paramsString = '';
        if (0 < \count($params)) {
            $paramsString = '?'.http_build_query($params);
        }

        $response = $this->httpGet("/v1/balance/history$paramsString");

        if (200 !== $response->getStatusCode()) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, BalanceTransactionCollection::class);
    }
}
