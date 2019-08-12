<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Api;

use Shapin\Stripe\Configuration;
use Shapin\Stripe\Exception;
use Shapin\Stripe\Model\Invoice\Invoice as InvoiceModel;
use Shapin\Stripe\Model\Invoice\InvoiceCollection;
use Symfony\Component\Config\Definition\Processor;

final class Invoice extends HttpApi
{
    /**
     * @throws Exception
     */
    public function get(string $id)
    {
        $response = $this->httpGet("invoices/$id");

        return $this->hydrator->hydrate($response, InvoiceModel::class);
    }

    /**
     * @throws Exception
     */
    public function all(array $params = [])
    {
        $processor = new Processor();
        $params = $processor->processConfiguration(new Configuration\InvoiceList(), [$params]);

        $response = $this->httpGet('invoices', $params);

        return $this->hydrator->hydrate($response, InvoiceCollection::class);
    }

    /**
     * @throws Exception
     */
    public function pay(string $id, array $params = [])
    {
        $processor = new Processor();
        $processor->processConfiguration(new Configuration\InvoicePay(), [$params]);

        $response = $this->httpPost("invoices/$id/pay", $params);

        return $this->hydrator->hydrate($response, InvoiceModel::class);
    }
}
