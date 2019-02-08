<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Api;

use Shapin\Stripe\Exception;
use Shapin\Stripe\Model\Invoice\Invoice as InvoiceModel;
use Shapin\Stripe\Model\Invoice\InvoiceCollection;

final class Invoice extends HttpApi
{
    /**
     * @throws Exception
     */
    public function get(string $id)
    {
        $response = $this->httpGet("/v1/invoices/$id");

        if (200 !== $response->getStatusCode()) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, InvoiceModel::class);
    }

    /**
     * @throws Exception
     */
    public function all(array $params = [])
    {
        $response = $this->httpGet('/v1/invoices'.http_build_query($params));

        if (200 !== $response->getStatusCode()) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, InvoiceCollection::class);
    }
}