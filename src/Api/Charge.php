<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace FAPI\Stripe\Api;

use FAPI\Stripe\Exception;
use FAPI\Stripe\Exception\InvalidArgumentException;
use FAPI\Stripe\Model\Charge\Charge as ChargeModel;
use Psr\Http\Message\ResponseInterface;

final class Charge extends HttpApi
{
    /**
     * @throws Exception
     */
    public function get(string $id)
    {
        $response = $this->httpGet("/v1/charges/$id");

        if (!$this->hydrator) {
            return $response;
        }

        if ($response->getStatusCode() !== 200) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, ChargeModel::class);
    }
}
