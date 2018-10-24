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
     * @param array $params
     *
     * @return Total|ResponseInterface
     *
     * @throws Exception
     */
    public function total(array $params = [])
    {
        $response = $this->httpGet('/v1/stats', $params);

        if (!$this->hydrator) {
            return $response;
        }

        // Use any valid status code here
        if ($response->getStatusCode() !== 200) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, Total::class);
    }
}
