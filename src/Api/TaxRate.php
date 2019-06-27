<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Api;

use Shapin\Stripe\Configuration;
use Shapin\Stripe\Exception;
use Shapin\Stripe\Model\TaxRate\TaxRate as TaxRateModel;
use Shapin\Stripe\Model\TaxRate\TaxRateCollection;
use Symfony\Component\Config\Definition\Processor;

final class TaxRate extends HttpApi
{
    /**
     * @throws Exception
     */
    public function get(string $id)
    {
        $response = $this->httpGet("tax_rates/$id");

        return $this->hydrator->hydrate($response, TaxRateModel::class);
    }

    /**
     * @throws Exception
     */
    public function create(array $params)
    {
        $processor = new Processor();
        $processor->processConfiguration(new Configuration\TaxRateCreate(), [$params]);

        $response = $this->httpPost('tax_rates', $params);

        return $this->hydrator->hydrate($response, TaxRateModel::class);
    }

    /**
     * @throws Exception
     */
    public function all(array $params = [])
    {
        $response = $this->httpGet('tax_rates', $params);

        return $this->hydrator->hydrate($response, TaxRateCollection::class);
    }
}
