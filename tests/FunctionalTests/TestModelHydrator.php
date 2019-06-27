<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests\FunctionalTests;

use Shapin\Stripe\Hydrator\Hydrator;
use Shapin\Stripe\Hydrator\ModelHydrator;
use Symfony\Contracts\HttpClient\ResponseInterface;

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
        $reflection = new \ReflectionClass($response);
        $property = $reflection->getProperty('headers');
        $property->setAccessible(true);
        $property->setValue($response, array_merge($response->getHeaders(), ['content-type' => ['application/json']]));

        return $this->hydrator->hydrate($response, $class);
    }
}
