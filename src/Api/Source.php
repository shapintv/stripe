<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Api;

use Shapin\Stripe\Configuration;
use Shapin\Stripe\Exception;
use Shapin\Stripe\Model\Source\Source as SourceModel;
use Symfony\Component\Config\Definition\Processor;

final class Source extends HttpApi
{
    /**
     * @throws Exception
     */
    public function get(string $id)
    {
        $response = $this->httpGet("sources/$id");

        return $this->hydrator->hydrate($response, SourceModel::class);
    }

    /**
     * @throws Exception
     */
    public function create(array $params)
    {
        $processor = new Processor();
        $processor->processConfiguration(new Configuration\SourceCreate(), [$params]);

        $response = $this->httpPost('sources', $params);

        return $this->hydrator->hydrate($response, SourceModel::class);
    }
}
