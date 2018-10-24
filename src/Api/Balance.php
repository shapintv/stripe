<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace FAPI\Stripe\Api;

use FAPI\Stripe\Exception;
use FAPI\Stripe\Exception\InvalidArgumentException;
use FAPI\Stripe\Model\Balance\Balance as BalanceModel;
use FAPI\Stripe\Model\Balance\BalanceTransaction;
use Psr\Http\Message\ResponseInterface;

final class Balance extends HttpApi
{
    /**
     * @throws Exception
     */
    public function get(): BalanceModel
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
    public function getBalanceTransaction(string $id): BalanceTransaction
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
}
