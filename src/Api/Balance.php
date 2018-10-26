<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Api;

use Shapin\Stripe\Exception;
use Shapin\Stripe\Exception\InvalidArgumentException;
use Shapin\Stripe\Model\Balance\Balance as BalanceModel;
use Shapin\Stripe\Model\Balance\BalanceTransaction;
use Shapin\Stripe\Model\Balance\BalanceTransactionCollection;
use Psr\Http\Message\ResponseInterface;

final class Balance extends HttpApi
{
    /**
     * @throws Exception
     */
    public function get()
    {
        $response = $this->httpGet('/v1/balance');

        if (!$this->hydrator) {
            return $response;
        }

        if ($response->getStatusCode() !== 200) {
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

        if (!$this->hydrator) {
            return $response;
        }

        if ($response->getStatusCode() !== 200) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, BalanceTransaction::class);
    }

    /**
     * @throws Exception
     */
    public function getBalanceTransactions(array $params = [])
    {
        $response = $this->httpGet('/v1/balance/history'.http_build_query($params));

        if (!$this->hydrator) {
            return $response;
        }

        if ($response->getStatusCode() !== 200) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, BalanceTransactionCollection::class);
    }
}
