<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe;

use Http\Discovery\MessageFactoryDiscovery;
use Http\Message\MultipartStream\MultipartStreamBuilder;
use Http\Message\RequestFactory;
use Psr\Http\Message\RequestInterface;

/**
 * @internal this class should not be used outside of the API Client, it is not part of the BC promise
 */
final class HttpQueryBuilder
{
    public function build(array $params): string
    {
        if (0 === \count($params)) {
            return '';
        }

        $parts = $this->getParts($params);

        $resolvedParams = [];
        foreach ($parts as $key => $value) {
            $resolvedParams[] = "$key=$value";
        }

        if (0 === count($resolvedParams)) {
            return '';
        }

        return implode('&', $resolvedParams);
    }

    private function getParts(array $params, string $prefix = null): array
    {
        $parts = [];
        foreach ($params as $key => $value) {
            if (is_array($value)) {
                $newPrefix = null === $prefix ? $key : $prefix.'['.$key.']';
                $subParts = $this->getParts($value, $newPrefix);

                $parts += $subParts;

                continue;
            }

            $param = $this->sanitizeParam($value);

            if (null === $prefix) {
                $parts[$key] = $param;
            } else {
                $parts[$prefix.'['.$key.']'] = $param;
            }
        }

        return $parts;
    }

    private function sanitizeParam($param): string
    {
        if (is_bool($param)) {
            return $param ? 'true' : 'false';
        }

        return (string) $param;
    }
}
