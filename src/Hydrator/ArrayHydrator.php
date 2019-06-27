<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Hydrator;

use Shapin\Stripe\Exception\HydrationException;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * Hydrate an HTTP response to array.
 */
final class ArrayHydrator implements Hydrator
{
    /**
     * @param ResponseInterface $response
     * @param string            $class
     *
     * @return array
     */
    public function hydrate(ResponseInterface $response, string $class): array
    {
        if (!isset($response->getHeaders()['content-type'])) {
            throw new HydrationException('The ArrayHydrator cannot hydrate response without Content-Type.');
        }

        $contentType = reset($response->getHeaders()['content-type']);
        if (0 !== strpos($contentType, 'application/json')) {
            throw new HydrationException("The ArrayHydrator cannot hydrate response with Content-Type: $contentType.");
        }

        $content = json_decode($response->getContent(), true);
        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new HydrationException(sprintf('Error (%d) when trying to json_decode response', json_last_error()));
        }

        return $content;
    }
}
