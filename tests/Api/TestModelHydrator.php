<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace FAPI\Stripe\Tests\Api;

use FAPI\Stripe\Hydrator\Hydrator;
use FAPI\Stripe\Hydrator\ModelHydrator;
use Psr\Http\Message\ResponseInterface;

final class TestModelHydrator implements Hydrator
{
    private $hydrator;

    public function __construct()
    {
        $this->hydrator = new ModelHydrator();
    }

    /**
     * {@inheritdoc}
     */
    public function hydrate(ResponseInterface $response, string $class)
    {
        return $this->hydrator->hydrate(
            $response->withHeader('Content-Type', 'application/json'),
            $class
        );
    }
}
